<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Attribute;
use App\Models\ProductAttribute;
use App\Models\Brand;
use Exception;
use stdClass;

class ProductImport implements ToCollection, WithBatchInserts, WithChunkReading
	// , ShouldQueue
{
	private $user, $overwrite;
	private $skipRow = 3;
	private $headers = [];
	private $headerInited = false;
	private $indexedHeaders = [];

	private $key = "series_no";

	private $log;
	public $successCount;
	public $skipCount;
	public $skipReasons = [];
	public $skipSummary = [];

	public function __construct($user, $overwrite, $log = false) {
		$this->user = $user;
		$this->overwrite = $overwrite;
		$this->successCount = 0;
		$this->skipCount = 0;
		$this->log = $log;
	}

	public function initHeaders() {

        $header = new stdClass;
        $header->name = "Product Image Name";
        array_push($this->headers, $header);

        $header = new stdClass;
        $header->name = "SubCategory";
        array_push($this->headers, $header);

        $header = new stdClass;
		$header->name = "Product_attributes";
		$header->expandable = true;
		array_push($this->headers, $header);

		$header = new stdClass;
		$header->name = "Series No";
		array_push($this->headers, $header);

		$header = new stdClass;
		$header->name = "Product Name";
		array_push($this->headers, $header);

		$header = new stdClass;
		$header->name = "Product Description";
		array_push($this->headers, $header);

		$header = new stdClass;
		$header->name = "Product Brands";
		array_push($this->headers, $header);

		$header = new stdClass;
		$header->name = "Price";
		array_push($this->headers, $header);

		$header = new stdClass;
		$header->name = "Category";
		array_push($this->headers, $header);

		$header = new stdClass;
		$header->name = "Specification.ATTACHMENT";
		array_push($this->headers, $header);

		$header = new stdClass;
		$header->name = "Specification.Page_To";
		array_push($this->headers, $header);

		$header = new stdClass;
		$header->name = "Specification.Page_From";
		array_push($this->headers, $header);

		$header = new stdClass;
		$header->name = "Dimension.ATTACHMENT";
		array_push($this->headers, $header);

		$header = new stdClass;
		$header->name = "Dimension.Page_To";
		array_push($this->headers, $header);

		$header = new stdClass;
		$header->name = "Dimension.Page_From";
		array_push($this->headers, $header);
	}

    public function batchSize(): int
    {
        return 500;
    }

    public function chunkSize(): int
    {
        return 500;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {

		try{
			if(!$this->headerInited) {
				$this->initHeaders();
				$index = 1;

				// indexing row
				$unindexHeaders = $collection->get($index);
				$subUnindexHeaders = $collection->get($index + 1);

				$prevUnindexHeader = null;

				for ($h = 0; $h < count($unindexHeaders); $h++) {
					$found = false;
					$currentHeader = $unindexHeaders[$h] ?: $prevUnindexHeader;

					for ($i = 0; $i < count($this->headers) && !$found; $i++) {
						$header = $this->headers[$i];
						$headerArr = explode('.', $header->name);

						if ($currentHeader == $headerArr[0]) {
							if (isset($header->expandable) && $header->expandable) {
								for ($j = $h; $j < count($subUnindexHeaders); $j++)
								{
									if($subUnindexHeaders[$j]) {
										$this->indexedHeaders[$j] = $header->name . "." . $subUnindexHeaders[$j];
									}
								}
							} else {
								$headerName = $headerArr[0];

								if(count($headerArr) > 1)
								{
									$headerName .= "." . $subUnindexHeaders[$h];
								}

								$this->indexedHeaders[$h] = $headerName;
							}
							$found = true;
						}
					}

					$prevUnindexHeader = $currentHeader;
				}

				$this->headerInited = true;
			} else {
				$this->skipRow = 0;
			}

			$headedRows = [];
			for($i = $this->skipRow; $i < $collection->count(); $i++) {
				$item = $collection->get($i);

				$headedRow = [];

				foreach($this->indexedHeaders as $index => $header) {
					$headerArr = explode('.', $header);

					$data = isset($item[$index]) ? $item[$index] : null;
					if(count($headerArr) > 1) {
						$headedRow[$headerArr[0]][$headerArr[1]] = $data;
					} else {
						$headedRow[$headerArr[0]] = $data;
					}
				}

				array_push($headedRows, $headedRow);
			}

			$company = $this->user->company;

			if($company) {
				$target = $company;
			} else {
				$target = $this->user;
			}

			$rowIndex = $this->successCount + $this->skipCount;

			for ($cRowIndex = 0; $cRowIndex < count($headedRows); $cRowIndex++)
			{
				$row = $headedRows[$cRowIndex];

				$itemCode = isset($row[$this->key]) ? $row[$this->key] : "";
				$subItemCode = isset($row['Series No']) ? $row['Series No'] : $itemCode;

				if(!$subItemCode) {
					if($this->log) {
						$this->skipReasons[$rowIndex + $cRowIndex] = "Missing Item Code on row " . ($rowIndex + $cRowIndex);
					}
					$this->skipSummary["Missing Item Code"] = true;
					$this->skipCount++;
					continue;
				}

				$priceString = $row['Price'];

				if(!$priceString) {
					if($this->log) {
						$this->skipReasons[$rowIndex + $cRowIndex] = "Price is not filled on row " . ($rowIndex + $cRowIndex);
					}
					$this->skipSummary["Price is not filled"] = true;
					$this->skipCount++;
					continue;
				}

				$itemCode = "";

				if(!$itemCode) {
					$subItemCodeArr = explode("-", $subItemCode);
					$index = 0;
					$itemCodeString = "";

					while(count($subItemCodeArr) > $index && $index < 2) {
						if($itemCodeString != "") {
							$itemCodeString .= "-";
						}

						$itemCodeString .= $subItemCodeArr[$index];
						$index++;
					}

					$itemCode = $itemCodeString;
				}
echo $itemCode;
				$product = Product::withTrashed()->where('series_no', $itemCode)->where('company_id', $this->user->company->id)
                    ->where('user_id', $this->user->id)->first();

				if(!$product || $this->overwrite) {
					// if(!isset($row['PRODUCT_ATTRIBUTE']) || count($row['PRODUCT_ATTRIBUTE']) == 0) {
						// if($this->log) {
							// $this->skipReasons[$rowIndex + $cRowIndex] = "Missing PRODUCT_ATTRIBUTE for new item (" . $itemCode . ")on row " . ($rowIndex + $cRowIndex);
						// }
						// $this->skipCount++;
						// continue;
					// }

					if(!isset($row['Product Brands'])) {
						if($this->log) {
							$this->skipReasons[$rowIndex + $cRowIndex] = "Missing Product Brands for new item (" . $itemCode . ") on row " . ($rowIndex + $cRowIndex);
						}
						$this->skipSummary["Missing Product Brands for new item(" . $itemCode . ")"] = true;
						$this->skipCount++;
						continue;
					}

					$pCategory = isset($row['Category']) ? $row['Category']
						: (isset($row['SubCategory']) ? $row['SubCategory'] : null);

					if(!$pCategory) {
						if($this->log) {
							$this->skipReasons[$rowIndex + $cRowIndex] = "Missing Product Category for new item (" . $itemCode . ") on row " . ($rowIndex + $cRowIndex);
						}
						$this->skipSummary["Missing Product Category for new item(" . $itemCode . ")"] = true;
						$this->skipCount++;
						continue;
					}

					$sCategory = isset($row['SubCategory']) ? $row['SubCategory'] : null;

					$category = ProductCategory::withTrashed()->where('name', $sCategory)->first();

					if(!$category) {
						if($pCategory == $sCategory) {
							$category = new ProductCategory;
							$category->name = $pCategory;
							$category->url = preg_replace('/\s+/', '_', $category->name);
							$category->save();


						} else {
							$parentCategory = ProductCategory::withTrashed()->where('name', $pCategory)->first();

							if($parentCategory) {
								$category = new ProductCategory;
								$category->name = $sCategory;
								$category->slug = preg_replace('/\s+/', '_', $category->name);
								$category->parentCategory()->associate($parentCategory);
								$category->save();
							} else {
								$parentCategory = new ProductCategory;
								$parentCategory->name = $pCategory;
								$parentCategory->slug = preg_replace('/\s+/', '_', $parentCategory->name);
								$parentCategory->save();



								if($sCategory) {
									$category = new ProductCategory;
									$category->name = $sCategory;
									$category->slug = preg_replace('/\s+/', '_', $category->name);
									$category->parentCategory()->associate($parentCategory);
									$category->save();


								} else {
									$category = $parentCategory;
								}
							}
						}
					}

					$brand = Brand::where('name', $row['Product Brands'])->first();

					if(!$brand) {
						$brand = Brand::create([
							'name' => $row['Product Brands'],
                            'description' => $row['Product Brands'],
                            'slug' => preg_replace('/\s+/', '_', $row['Product Brands']),
							'order' => 0
						]);


					}


					$itemName = isset($row['Product Name']) ? $row['Product Name'] : $itemCode;

					if($product) {
						$product->update([
							'name' => $itemName,
							'series_no' => $itemCode,
                            'description' => $row['Product Description'],
							'brand_id' => $brand->id,
							'category_id' => $category->id,
                            'price' => $row['Price'],
							'slug' => preg_replace('/\s+/', '_', $itemName),
						]);

					} else {
						$product = Product::create([
							'name' => $itemName,
							'series_no' => $itemCode,
                            'description' => $row['Product Description'],
							'brand_id' => $brand->id,
							'category_id' => $category->id,
                            'price' => $row['Price'],
							'slug' => preg_replace('/\s+/', '_', $itemName),
                            'company_id'=> $this->user->company->id,
                            'user_id' => $this->user->id,
						]);

					}
				}
				if(isset($row['Product_attributes']) && count($row['Product_attributes']) > 0) {
					foreach($row['Product_attributes'] as $group => $value) {
						if($value) {
							$groupString = ucfirst($group);

							$Attributes = Attribute::where('name', $groupString)->first();

							if(!$Attributes) {
								$Attributes = Attribute::create([
									'name' => $groupString,
                                    'slug' => preg_replace('/\s+/', '_', $groupString),
									'is_range' => false,
                                    'type' => 'Text',
								]);

							}


							$attributeDetails = preg_split('#(?<=[0-9])(?=[A-z, ])#i', $value);
							$mValue = null;
							$name = "";

							foreach($attributeDetails as $details) {
								if(is_numeric($details)) {
									$mValue = $details;
								} else {
									$name = $details;
								}
							}

							if($mValue) {
								// is range type
                                $Attributes->is_range = true;
                                $Attributes->type = 'number';
                                $Attributes->save();

								$mValue = $attributeDetails[0];
								$measurement = $Attributes->attributemeasurement()->where('name', $name)->first();

								if(!$measurement) {

									$measurement = $Attributes->attributemeasurement()->create([
										'max' => $mValue,
										'min' => $mValue,
										'name' => $name,
									]);
								} else {
									if($attributeDetails[0] < $measurement->min) {
										$measurement->min = $mValue;
									}

									if($attributeDetails[0] > $measurement->max) {
										$measurement->max = $mValue;
									}

									$measurement->save();
								}
                                $value=$mValue;
							}

                            $pAttributes = $product->productAttribute()->where('attribute_id', $Attributes->id)->first();


                            if(!$pAttributes) {
                                if($measurement){
                                    $product->productAttribute()->create([
                                        'value' => $value,
                                        'attribute_id' => $Attributes->id,
                                        'product_id' => $product->id,
                                        'attribute_measurement_id' => $measurement->id
                                    ]);

                                }
                                else{
                                    $product->productAttribute()->create([
                                        'value' => $value,
                                        'attribute_id' => $Attributes->id,
                                        'product_id' => $product->id,
                                    ]);
                                }
                            }
						}
					}
				}

				if(isset($row['Specification']) && $row['Specification']['Attachment']) {
					$attachmentName = 'companies/'.$this->user->company->id.'/products/' . strtolower($row['Specification']['Attachment']);

					$attachment = $product->productAttachment()->where('name', 'specification')
						->where('file_path', $attachmentName)->first();

					$fromPage = $row['Specification']['Page_From'] ?: 0;
					$toPage = $row['Specification']['Page_To'] ?: $row['Specification']['Page_From'];

					if(!$attachment) {
						$attachment = $product->productAttachment()->create([
							'file_path' => $attachmentName,
							'name' => 'specification',
							'page_to' => $toPage,
							'page_from' => $fromPage
						]);


					} else if($this->overwrite) {
						// should add to change request
						$attachment->update([
							'file_path' => $attachmentName,
							'name' => 'specification',
							'page_to' => $toPage,
							'page_from' => $fromPage
						]);
					}
				}

				if(isset($row['Dimension']) && $row['Dimension']['Attachment']) {
					$attachmentName = 'companies/'.$this->user->company->id.'/products/' . strtolower($row['Dimension']['Attachment']);

					$attachment = $product->productAttachment()->where('name', 'dimension')
						->where('file_path', $attachmentName)->first();

					$fromPage = $row['Dimension']['Page_From'] ?: 0;
					$toPage = $row['Dimension']['Page_To'] ?: $row['Dimension']['Page_From'];

					if(!$attachment) {
						$attachment = $product->productAttachment()->create([
							'file_path' => $attachmentName,
							'name' => 'dimension',
							'page_to' => $toPage,
							'page_from' => $fromPage
						]);


					} else if($this->overwrite) {
						// should add to change request
						$attachment->update([
							'file_path' => $attachmentName,
							'name' => 'dimension',
							'page_to' => $toPage,
							'page_from' => $fromPage
						]);
					}
				}

				if($row['Product Image Name']) {
					$imageName =  'companies/'.$this->user->company->id.'/products/'.strtolower($row['Product Image Name']);
					$pImage = $product->productImage()->where('path', $imageName)->first();

					if(!$pImage) {
						$pImage = $product->productImage()->create([
							'name' => 'image_thumbnail',
							'path' => $imageName
						]);


					} else if($this->overwrite) {
						// should add to change request
						$pImage->update([
							'name' => 'image_thumbnail',
							'path' => $imageName
						]);
					}
				}


				$this->successCount++;
			}
		} catch(Exception $ex) {
			dd($ex);
			throw $ex;
		}
    }
}
