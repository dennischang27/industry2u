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
            [ 'name' => "TECO", 'slug'=>"teco", 'description'=>"Teco", 'logo'=>"teco.png" ],
            [ 'name' => "ABB", 'slug'=>"abb", 'description'=>"ABB", 'logo'=>"abb.png"],
            [ 'name' => "CMP", 'slug'=>"cmp", 'description'=>"CMP", 'logo'=>"cmp.png"],
            [ 'name' => "MEIDEN", 'slug'=>"meiden", 'description'=>"meiden", 'logo'=>"meiden.png"],
            [ 'name' => "OLI", 'slug'=>"oli", 'description'=>"oli", 'logo'=>"oli.png"],
            [ 'name' => "BROVINI", 'slug'=>"brovini", 'description'=>"brovini", 'logo'=>"brovini.png"],
            [ 'name' => "SUMITOMO", 'slug'=>"sumitomo", 'description'=>"sumitomo", 'logo'=>"sumitomo.png"],
        ];

        foreach($datas as $data) {
            Brand::firstOrCreate($data);
        }
    }
}
