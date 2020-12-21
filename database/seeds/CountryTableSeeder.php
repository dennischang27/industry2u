<?php

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [ 'name' => "Malaysia", 'code'=>"MY"],
        ];

        foreach($datas as $data) {
            Country::firstOrCreate($data);
        }
    }
}
