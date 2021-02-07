<?php

namespace App\Exports;

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
	private $pAttrHeaders;

	public function __construct($attributes) {
		$this->attributes = $attributes;
		$this->pAttrHeaders = [];
	}

    public function headings(): array
    {
		$headers = [];

		$headers[0] = ['PLEASE FILL IN AFTER THE LINE'];

		$headers[1] = [ 'Category', 'SubCategory', 'Product Name','Series No',  'Product Description','Product Brands'
		,   'Price', 'Product Image Name',  'Specification', '', '', 'Dimension', '', ''
		,  'Product_attributes'];

		$headers[2] = [ '', '', '', '', '', '', '', '', 'Attachment', 'Page_From', 'Page_To', 'Attachment', 'Page_From', 'Page_To'
		];
		foreach($this->attributes as $ag) {
			$headerIndex = array_push($headers[2], $ag->name);

			$this->pAttrHeaders[$ag->id] = $headerIndex;
		}



        return $headers;
    }

	public static function afterSheet(AfterSheet $event)
    {
		$sheet = $event->sheet->getDelegate();

		$sheet->mergeCells('A1:Z1');

		$sheet->mergeCells('I2:K2');
		$sheet->mergeCells('L2:N2');
		$sheet->mergeCells('O2:Z2');
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

		$sheet->getStyle('I2:K2')->applyFromArray([
			'alignment' => [
				'horizontal' => Alignment::HORIZONTAL_CENTER,
			],
		]);

		$sheet->getStyle('L2:N2')->applyFromArray([
			'alignment' => [
				'horizontal' => Alignment::HORIZONTAL_CENTER,
			],
		]);

		$sheet->getStyle('O2:Z2')->applyFromArray([
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
