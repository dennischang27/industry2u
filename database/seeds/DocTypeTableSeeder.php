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
            [ 'name' => "SSM Form 9", 'input_name' => "ssm_form9",'position' => "1",'type' => "SSM" ],
            [ 'name' => "SSM Form 24", 'input_name' => "ssm_form24",'position' => "2",'type' => "SSM" ],
            [ 'name' => "SSM Form 49", 'input_name' => "ssm_form49",'position' => "3",'type' => "SSM" ],
            [ 'name' => "SST Document", 'input_name' => "sst_doc",'position' => "1",'type' => "SST" ],
        ];

        foreach($datas as $data) {
            DocType::firstOrCreate($data);
        }
    }
}
