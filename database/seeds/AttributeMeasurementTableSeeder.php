<?php

use Illuminate\Database\Seeder;
use App\Models\AttributeMeasurement;

class AttributeMeasurementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AttributeMeasurement::create( [
            'id'=>1,
            'max'=>420,
            'min'=>0,
            'name'=>'Hp',
            'attribute_id'=>1
        ] );



        AttributeMeasurement::create( [
            'id'=>2,
            'max'=>3,
            'min'=>3,
            'name'=>' Phase',
            'attribute_id'=>2
        ] );



        AttributeMeasurement::create( [
            'id'=>3,
            'max'=>415,
            'min'=>220,
            'name'=>' Volt',
            'attribute_id'=>3
        ] );



        AttributeMeasurement::create( [
            'id'=>4,
            'max'=>710,
            'min'=>0,
            'name'=>'Kw',
            'attribute_id'=>1
        ] );



        AttributeMeasurement::create( [
            'id'=>5,
            'max'=>355,
            'min'=>80,
            'name'=>'M',
            'attribute_id'=>6
        ] );



        AttributeMeasurement::create( [
            'id'=>6,
            'max'=>6,
            'min'=>2,
            'name'=>' POLE',
            'attribute_id'=>7
        ] );



        AttributeMeasurement::create( [
            'id'=>7,
            'max'=>315,
            'min'=>90,
            'name'=>'S',
            'attribute_id'=>6
        ] );



        AttributeMeasurement::create( [
            'id'=>8,
            'max'=>355,
            'min'=>90,
            'name'=>'L',
            'attribute_id'=>6
        ] );



        AttributeMeasurement::create( [
            'id'=>9,
            'max'=>1788,
            'min'=>1,
            'name'=>'Kgcm',
            'attribute_id'=>8
        ] );



        AttributeMeasurement::create( [
            'id'=>11,
            'max'=>112,
            'min'=>56,
            'name'=>'B14',
            'attribute_id'=>6
        ] );



        AttributeMeasurement::create( [
            'id'=>12,
            'max'=>132,
            'min'=>56,
            'name'=>'B5',
            'attribute_id'=>6
        ] );



        AttributeMeasurement::create( [
            'id'=>13,
            'max'=>315,
            'min'=>315,
            'name'=>'C',
            'attribute_id'=>6
        ] );
    }
}
