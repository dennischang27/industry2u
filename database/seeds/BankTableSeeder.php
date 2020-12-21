<?php

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [ 'name' => "Affin Bank", 'code'=>"AFFIN"],
            [ 'name' => "AmBank", 'code'=>"AMBANK"],
            [ 'name' => "Bank Islam Malaysia", 'code'=>"BANKISLAM"],
            [ 'name' => "CIMB Bank", 'code'=>"CIMB"],
            [ 'name' => "Hong Leong Bank", 'code'=>"HLBANK"],
            [ 'name' => "MayBank", 'code'=>"MAYBANK"],
            [ 'name' => "OCBC Bank Malaysia", 'code'=>"OCBC"],
            [ 'name' => "Public Bank Berhad", 'code'=>"PBBANK"],
            [ 'name' => "RHB Bank", 'code'=>"RHB"],
            [ 'name' => "UOB Malaysia Bank", 'code'=>"UOB"],
            [ 'name' => "Bank Rakyat", 'code'=>"Rakyat"],
            [ 'name' => "HSBC Bank Malaysia", 'code'=>"HSBC"],
            [ 'name' => "Standard Chartered Bank Malaysia", 'code'=>"SCBANK"],
            [ 'name' => "CitiBank Malaysia", 'code'=>"CITIBANK"],
            [ 'name' => "Bank Simpanan Nasional", 'code'=>"BSN"],
            [ 'name' => "Bank Muamalat Malaysia Berhad", 'code'=>"BMMB"],
            [ 'name' => "Agrobank", 'code'=>"AGROBANK"],
            [ 'name' => "Al-Rajhi Malaysia", 'code'=>"ALRAJ"],
            [ 'name' => "MBSB Bank Berhad", 'code'=>"MBSB"],
            [ 'name' => "Co-op Bank Pertama", 'code'=>"BANKPERTAMA"],
            [ 'name' => "Alliance Bank", 'code'=>"ALLIANCE"],
        ];

        foreach($datas as $data) {
            Bank::firstOrCreate($data);
        }
    }
}
