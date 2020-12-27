<?php

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [ 'name' => "TECO", 'slug'=>"teco", 'description'=>"Teco", 'logo'=>"teco_brand.jpg" ],
            [ 'name' => "ABB", 'slug'=>"abb", 'description'=>"ABB", 'logo'=>"abb_brand.jpg"],
            [ 'name' => "CMP", 'slug'=>"cmp", 'description'=>"CMP", 'logo'=>"cmp_brand.jpg"],
            [ 'name' => "MEIDEN", 'slug'=>"meiden", 'description'=>"meiden", 'logo'=>"maiden_brand.jpg"],
            [ 'name' => "OLI", 'slug'=>"oli", 'description'=>"oli", 'logo'=>"oli_brand.jpg"],
            [ 'name' => "BROVINI", 'slug'=>"brovini", 'description'=>"brovini", 'logo'=>"brovini.jpg"],
            [ 'name' => "SUMITOMO", 'slug'=>"sumitomo", 'description'=>"sumitomo", 'logo'=>"sumimoto_brand.jpg"],
        ];

        foreach($datas as $data) {
            Brand::firstOrCreate($data);
        }
    }
}
