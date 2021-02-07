<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomQuerySize;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class MyProductExport implements FromQuery, WithEvents, ShouldAutoSize, WithHeadings, WithMapping
{
    use RegistersEventListeners;

	private $attributes;
	private $myProductQuery;
	private $pAttrHeaders;

	public function __construct($attributes, $myProductQuery) {
		$this->attributes = $attributes;
		$this->myProductQuery = $myProductQuery->join('product_categories', 'product_categories.id', '=', 'products.category_id')
			->leftJoin('product_categories as parent_product_categories', 'parent_product_categories.id', '=', 'product_categories.parent_id')
			->join('brands', 'brands.id', '=', 'products.brand_id')->select([
				'products.id',
				'products.series_no',
				'products.name',
				'products.description',
				'products.price',
				'parent_product_categories.name as parent_category_name',
				'product_categories.name as category_name',
				'brands.name as brand_name',
			])
			->groupBy([
                'products.series_no',
                'products.name',
                'products.description',
                'products.price',
                'parent_product_categories.name as parent_category_name',
                'product_categories.name as category_name',
                'brands.name as brand_name',
			])
			->orderBy('products.id', 'asc');

		$this->pAttrHeaders = [];
	}

	public function query()
    {
        return $this->myProductQuery;
    }

    public function headings(): array
    {
		$headers = [];

		$headers[0] = ['PLEASE FILL IN AFTER THE LINE'];

		$headers[1] = [ 'Category', 'Subcategory', 'Product Name', 'Series No','Product Description', 'Pricing'
		, 'Product Brands', 'Product Image Name', 'Specification', '', '', 'Dimension', '', ''
		, 'UNIT_MEASUREMENT', 'PRODUCT_ATTRIBUTE'];

		$headers[2] = [ '', '', '', '', '', '', '', '', 'ATTACHMENT', 'Page_From', 'Page_To', 'ATTACHMENT', 'Page_From', 'Page_To'
		, ''];

		foreach($this->attributes as $ag) {
			$headerIndex = array_push($headers[2], $ag->name);

			$this->pAttrHeaders[$ag->id] = $headerIndex;
		}

        return $headers;
    }

	/**
    * @var mixed $product
    */
    public function map($product): array
    {
        // This example will return 3 rows.
        // First row will have 2 column, the next 2 will have 1 column
		$data = [
			$product->name,
            $product->series_no,
			$product->description,
			$product->price,
			$product->parent_category_name ? : $product->category_name,
			$product->parent_category_name ? $product->category_name : null,
			$product->brand_name,
			'',
			'',
			'',
			'',
			'',
			'',
			'',
		];

		// $pResult = $product->specializedProduct()->with(['spAttributes', 'spAttributes.pAttribute', 'spAttributes.pAttribute.attribute'])->first();

		// foreach($pResult->spAttributes as $pAttr) {
			// $pAttrHeader = isset($this->pAttrHeaders[$pAttr->pAttribute->group_id]) ? $this->pAttrHeaders[$pAttr->pAttribute->group_id] : null;

			// if($pAttrHeader) {
				// $data[$pAttrHeader] = $pAttr->pAttribute->attribute->name;
			// }
		// }

        return $data;
    }

	public static function afterSheet(AfterSheet $event)
    {
		$sheet = $event->sheet->getDelegate();
		// $sheet->getProtection()->setPassword('password');
		// $sheet->getProtection()->setSheet(true);

		// $sheet->getStyle('B1:D100')->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);

		$sheet->mergeCells('A1:X1');

		$sheet->mergeCells('J2:L2');
		$sheet->mergeCells('M2:O2');
		$sheet->mergeCells('Q2:Y2');

		$sheet->getStyle('A1:Y1')->applyFromArray([
			'alignment' => [
				'horizontal' => Alignment::HORIZONTAL_CENTER,
			],

			'font' => [
				'color' => [
					'rgb' => 'FFFFFF',
				]
			],

			'fill' => [
				'fillType' => Fill::FILL_SOLID,
                'startColor' => [
					'rgb' => 'FF0000',
				]
			]
		]);

		$sheet->getStyle('J2:L2')->applyFromArray([
			'alignment' => [
				'horizontal' => Alignment::HORIZONTAL_CENTER,
			],
		]);

		$sheet->getStyle('M2:O2')->applyFromArray([
			'alignment' => [
				'horizontal' => Alignment::HORIZONTAL_CENTER,
			],
		]);

		$sheet->getStyle('Q2:Y2')->applyFromArray([
			'alignment' => [
				'horizontal' => Alignment::HORIZONTAL_CENTER,
			],
		]);

		$sheet->getStyle('A3:Y3')->applyFromArray([
			'borders' => [
				'bottom' => [
					'borderStyle' => Border::BORDER_THICK,
				]
			],
		]);
    }
}
