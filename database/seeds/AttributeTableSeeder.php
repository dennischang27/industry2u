<?php
use App\Models\Attribute;
use Illuminate\Database\Seeder;

class AttributeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Attribute::create( [
            'id'=>1,
            'name'=>'POWER',
            'slug'=>'power',
            'type'=>'number',
            'attribute_group_id'=>1,
            'is_range'=>1
        ] );



        Attribute::create( [
            'id'=>2,
            'name'=>'PHASE',
            'type'=>'number',
            'slug'=>'phase',
            'attribute_group_id'=>1,
            'is_range'=>1,
        ] );



        Attribute::create( [
            'id'=>3,
            'name'=>'VOLTAGE',
            'slug'=>'voltage',
            'type'=>'number',
            'attribute_group_id'=>1,
            'is_range'=>1,
        ] );



        Attribute::create( [
            'id'=>4,
            'name'=>'PROTECTION',
            'slug'=>'protection',
            'type'=>'text',
            'attribute_group_id'=>1,
            'is_range'=>0,
        ] );



        Attribute::create( [
            'id'=>5,
            'name'=>'MOUNTING',
            'slug'=>'mounting',
            'type'=>'text',
            'attribute_group_id'=>1,
            'is_range'=>0,
        ] );



        Attribute::create( [
            'id'=>6,
            'name'=>'FRAME',
            'slug'=>'frame',
            'type'=>'number',
            'attribute_group_id'=>1,
            'is_range'=>1,
        ] );



        Attribute::create( [
            'id'=>7,
            'name'=>'POLE',
            'slug'=>'pole',
            'type'=>'number',
            'attribute_group_id'=>1,
            'is_range'=>1,
        ] );



        Attribute::create( [
            'id'=>8,
            'name'=>'FORCE',
            'slug'=>'force',
            'type'=>'number',
            'attribute_group_id'=>1,
            'is_range'=>1,
        ] );



        Attribute::create( [
            'id'=>9,
            'name'=>'RATIO',
            'slug'=>'ratio',
            'type'=>'number',
            'attribute_group_id'=>1,
            'is_range'=>1,
        ] );



        Attribute::create( [
            'id'=>11,
            'name'=>'SIZE',
            'slug'=>'size',
            'type'=>'number',
            'attribute_group_id'=>1,
            'is_range'=>1,
        ] );



        Attribute::create( [
            'id'=>12,
            'name'=>'BOOTH',
            'slug'=>'Booth',
            'type'=>'number',
            'attribute_group_id'=>1,
            'is_range'=>1,
        ] );



        Attribute::create( [
            'id'=>13,
            'name'=>'AIR DELIVERY',
            'slug'=>'air_delivery',
            'type'=>'number',
            'attribute_group_id'=>1,
            'is_range'=>1,
        ] );



        Attribute::create( [
            'id'=>14,
            'name'=>'CUT',
            'slug'=>'cut',
            'type'=>'text',
            'attribute_group_id'=>1,
            'is_range'=>0,
        ] );



        Attribute::create( [
            'id'=>15,
            'name'=>'TYPE',
            'slug'=>'Type',
            'type'=>'text',
            'attribute_group_id'=>1,
            'is_range'=>0,
        ] );



        Attribute::create( [
            'id'=>16,
            'name'=>'Air Outlet',
            'slug'=>'air_outlet',
            'type'=>'number',
            'attribute_group_id'=>1,
            'is_range'=>1,
        ] );



        Attribute::create( [
            'id'=>17,
            'name'=>'Motor Outputs KW (HP)',
            'slug'=>'Motor_Outputs_KW',
            'type'=>'text',
            'attribute_group_id'=>1,
            'is_range'=>0,
        ] );



        Attribute::create( [
            'id'=>18,
            'name'=>'Motor No. Of Phase',
            'slug'=>'Motor_No_Of_Phase',
            'type'=>'text',
            'attribute_group_id'=>1,
            'is_range'=>0,
        ] );



        Attribute::create( [
            'id'=>19,
            'name'=>'Freq. (hz)',
            'slug'=>'freq_hz',
            'type'=>'text',
            'attribute_group_id'=>1,
            'is_range'=>0,
        ] );



        Attribute::create( [
            'id'=>20,
            'name'=>'Working pressure MPa (psi)',
            'slug'=>'Working_pressure_MPa_psi',
            'type'=>'text',
            'attribute_group_id'=>1,
            'is_range'=>0,
        ] );



        Attribute::create( [
            'id'=>21,
            'name'=>'Free air delivery ℓ /min. (cfm)',
            'slug'=>'free_air_delivery_min_cfm',
            'type'=>'text',
            'attribute_group_id'=>1,
            'is_range'=>0,
        ] );



        Attribute::create( [
            'id'=>22,
            'name'=>'Air Tank Volume ℓ (cft)',
            'slug'=>'air_tank_volume_cft',
            'type'=>'text',
            'attribute_group_id'=>1,
            'is_range'=>0,
        ] );



        Attribute::create( [
            'id'=>23,
            'name'=>'Air Tank Air cutlet size x No. of stop valve',
            'slug'=>'Air_Tank_Air_cutlet_size_No_of_stop_valve',
            'type'=>'text',
            'attribute_group_id'=>1,
            'is_range'=>0,
        ] );



        Attribute::create( [
            'id'=>24,
            'name'=>'Approx. mass (kg)',
            'slug'=>'approx_mass_kg',
            'type'=>'text',
            'attribute_group_id'=>1,
            'is_range'=>0,
        ] );



        Attribute::create( [
            'id'=>25,
            'name'=>'Noise level (at front 1.5m) dB (A)',
            'slug'=>'noise_level',
            'type'=>'text',
            'attribute_group_id'=>1,
            'is_range'=>0,
        ] );



        Attribute::create( [
            'id'=>26,
            'name'=>'Color',
            'slug'=>'color',
            'type'=>'text',
            'attribute_group_id'=>1,
            'is_range'=>0,
        ] );
    }
}
