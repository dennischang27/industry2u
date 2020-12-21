<?php

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [ 'name' => "Ringgit Malaysia", 'code'=>"MYR", 'symbol' => "MYR", 'decimals'=>"2", 'is_default'=>"1",  'exchange_rate'=>"1" ],
        ];

        foreach($datas as $data) {
            Currency::firstOrCreate($data);
        }
    }
}
