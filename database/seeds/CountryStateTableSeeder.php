<?php

use App\Models\CountryState;
use Illuminate\Database\Seeder;

class CountryStateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [ 'code' => "JHR",  'country_code' => "MY", 'name' => "Johor",'country_id' => 1],
            [ 'code' => "KDH",  'country_code' => "MY", 'name' => "Kedah	", 'country_id' => 1],
            [ 'code' => "KTN",  'country_code' => "MY", 'name' => "Kelantan", 'country_id' => 1],
            [ 'code' => "KUL",  'country_code' => "MY", 'name' => "Kuala Lumpur", 'country_id' => 1],
            [ 'code' => "TRG",  'country_code' => "MY", 'name' => "Terengganu", 'country_id' => 1],
            [ 'code' => "MLK",  'country_code' => "MY", 'name' => "Melaka", 'country_id' => 1],
            [ 'code' => "NSN",  'country_code' => "MY", 'name' => "Negeri Sembilan", 'country_id' => 1],
            [ 'code' => "PHG",  'country_code' => "MY", 'name' => "Pahang", 'country_id' => 1],
            [ 'code' => "PNG",  'country_code' => "MY", 'name' => "Penang", 'country_id' => 1],
            [ 'code' => "PRK",  'country_code' => "MY", 'name' => "Perak", 'country_id' => 1],
            [ 'code' => "PLS",  'country_code' => "MY", 'name' => "Perlis", 'country_id' => 1],
            [ 'code' => "SBH",  'country_code' => "MY", 'name' => "Sabah", 'country_id' => 1],
            [ 'code' => "SWK",  'country_code' => "MY", 'name' => "Sarawak", 'country_id' => 1],
            [ 'code' => "SGR",  'country_code' => "MY", 'name' => "Selangor", 'country_id' => 1],
            [ 'code' => "PJY",  'country_code' => "MY", 'name' => "Putrajaya", 'country_id' => 1],
            [ 'code' => "LBN",  'country_code' => "MY", 'name' => "Labuan", 'country_id' => 1],
        ];

        foreach($datas as $data) {
            CountryState::firstOrCreate($data);
        }
    }
}
