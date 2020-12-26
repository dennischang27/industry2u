<?php

use App\Models\CompanyBudgetRange;
use Illuminate\Database\Seeder;

class CompanyBudgetRangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [ 'id' => 1, 'name' => "Below 50,000", 'from' => 0, 'to' => 50000],
            [ 'id' => 2, 'name' => "50,001 - 80,000", 'from' => 50001, 'to' => 80000],
            [ 'id' => 3, 'name' => "Above 80,000", 'from' => 80001, 'to' => null],
        ];

        foreach($datas as $data) {
            CompanyBudgetRange::firstOrCreate($data);
        }
    }
}
