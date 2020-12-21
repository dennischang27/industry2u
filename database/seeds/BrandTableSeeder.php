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
            [ 'name' => "TECO", 'slug'=>"teco", 'descriptions'=>"Teco", 'logo'=>"teco.png" ],
            [ 'name' => "ABB", 'slug'=>"abb", 'descriptions'=>"ABB", 'logo'=>"abb.png"],
            [ 'name' => "CMP", 'slug'=>"cmp", 'descriptions'=>"CMP", 'logo'=>"cmp.png"],
            [ 'name' => "MEIDEN", 'slug'=>"meiden", 'descriptions'=>"meiden", 'logo'=>"meiden.png"],
            [ 'name' => "OLI", 'slug'=>"oli", 'descriptions'=>"oli", 'logo'=>"oli.png"],
            [ 'name' => "BROVINI", 'slug'=>"brovini", 'descriptions'=>"brovini", 'logo'=>"brovini.png"],
            [ 'name' => "SUMITOMO", 'slug'=>"sumitomo", 'descriptions'=>"sumitomo", 'logo'=>"sumitomo.png"],
        ];

        foreach($datas as $data) {
            Brand::firstOrCreate($data);
        }
    }
}
