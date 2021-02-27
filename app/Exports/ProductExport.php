<?php

namespace App\Exports;

use App\Models\ProductCategory;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ProductExport implements	WithEvents, ShouldAutoSize, WithHeadings
{
    use RegistersEventListeners;

	private $attributes;
    private $categoryid;
	private $pAttrHeaders;

	public function __construct($attributes, $categoryid) {
		$this->attributes = $attributes;
        $this->categoryid = $categoryid;
		$this->pAttrHeaders = [];
	}

    public function headings(): array
    {

        $category =ProductCategory::findorfail($this->categoryid);
		$headers = [];

		$headers[0] = ['PLEASE FILL IN AFTER THE LINE'];

		$headers[1] = [ 'Category', 'SubCategory', 'Product Name','Series No', 'SKU',  'Product Description','Product Brands'
		,   'Price', 'Product Image Name',  'Specification', '', '', 'Dimension', '', ''
		,  'Product_attributes'];

		$headers[2] = [ '', '', '', '', '', '', '', '', '','Attachment', 'Page_From', 'Page_To', 'Attachment', 'Page_From', 'Page_To'
		];
		foreach($this->attributes as $ag) {
			$headerIndex = array_push($headers[2], $ag->name);

			$this->pAttrHeaders[$ag->id] = $headerIndex;
		}
        $headers[3] = [ $category->parentCategory->name, $category->name
        ];


        return $headers;
    }

	public static function afterSheet(AfterSheet $event)
    {
		$sheet = $event->sheet->getDelegate();

		$sheet->mergeCells('A1:Z1');

		$sheet->mergeCells('J2:L2');
		$sheet->mergeCells('M2:O2');
		$sheet->mergeCells('P2:Z2');
		$sheet->getStyle('A1:Z1')->applyFromArray([
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

		$sheet->getStyle('P2:Z2')->applyFromArray([
			'alignment' => [
				'horizontal' => Alignment::HORIZONTAL_CENTER,
			],
		]);

		$sheet->getStyle('A3:Z3')->applyFromArray([
			'borders' => [
				'bottom' => [
					'borderStyle' => Border::BORDER_THICK,
				]
			],
		]);
    }
}
