<?php

use App\Models\DocType;
use Illuminate\Database\Seeder;

class DocTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [ 'name' => "SSM"],
            [ 'name' => "SST Document"],
        ];

        foreach($datas as $data) {
            DocType::firstOrCreate($data);
        }
    }
}
