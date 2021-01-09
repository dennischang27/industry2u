<?php
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        ProductCategory::create( [
            'id'=>1,
            'name'=>'AC DRIVE',
            'slug'=>'ac_drive',
            'image'=>'abb inverter acs150.jpg',
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-03-01 22:38:36',
            'updated_at'=>'2020-03-01 22:38:36',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>2,
            'name'=>'FREQUENCY INVERTER',
            'slug'=>'frequency_inverter',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>1,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-03-01 22:38:36',
            'updated_at'=>'2020-08-13 15:43:45',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>3,
            'name'=>'SOFT STARTER',
            'slug'=>'soft_starter',
            'image'=>'abb soft starter pse.jpg',
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-03-20 07:19:57',
            'updated_at'=>'2020-03-20 07:19:57',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>4,
            'name'=>'AC MOTOR',
            'slug'=>'ac_motor',
            'image'=>'cmp b3.jpg',
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-03-20 07:20:00',
            'updated_at'=>'2020-03-20 07:20:00',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>5,
            'name'=>'SQUIRELL CAGE',
            'slug'=>'squirell_cage',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>4,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-03-20 07:20:00',
            'updated_at'=>'2020-03-20 07:20:00',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>6,
            'name'=>'LOW VOLTAGE',
            'slug'=>'low_voltage',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>1,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-03-20 07:20:17',
            'updated_at'=>'2020-03-20 07:20:17',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>7,
            'name'=>'VIBRATOR',
            'slug'=>'vibrator',
            'image'=>'oli vibrator.jpg',
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-03-20 07:20:19',
            'updated_at'=>'2020-03-20 07:20:19',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>8,
            'name'=>'ELECTRIC VIBRATOR',
            'slug'=>'electric_vibrator',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>7,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-03-20 07:20:19',
            'updated_at'=>'2020-03-20 07:20:19',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>9,
            'name'=>'GEARBOXES',
            'slug'=>'gearboxes',
            'image'=>'brovini output flange.jpg',
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-03-20 07:20:23',
            'updated_at'=>'2020-08-13 15:43:03',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>10,
            'name'=>'GEARBOX OUTPUT FLANGE',
            'slug'=>'gearbox_output_flange',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>9,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-03-20 07:20:23',
            'updated_at'=>'2020-03-20 07:20:23',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>11,
            'name'=>'GEARBOX INTPUT FLANGE',
            'slug'=>'gearbox_intput_flange',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>9,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-03-20 07:20:24',
            'updated_at'=>'2020-03-20 07:20:24',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>12,
            'name'=>'GEARBOX OUTPUT SHAFT',
            'slug'=>'gearbox_output_shaft',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>9,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-03-20 07:20:25',
            'updated_at'=>'2020-03-20 07:20:25',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>13,
            'name'=>'NMRV WORM GEARBOX',
            'slug'=>'nmrv_worm_gearbox',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>9,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-03-20 07:20:25',
            'updated_at'=>'2020-03-20 07:20:25',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>14,
            'name'=>'CYCLO DRIVE',
            'slug'=>'cyclo_drive',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>9,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-03-20 07:20:44',
            'updated_at'=>'2020-03-20 07:20:44',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>17,
            'name'=>'PARALLEL',
            'slug'=>'parallel',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>9,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-03-20 07:28:15',
            'updated_at'=>'2020-03-20 07:28:15',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>18,
            'name'=>'HYPONIC GEARBOX',
            'slug'=>'hyponic_gearbox',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>9,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-03-20 07:28:18',
            'updated_at'=>'2020-03-20 07:28:18',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>19,
            'name'=>'HELICAL  GEAR BOX',
            'slug'=>'helical_gear_box',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>9,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-03-20 07:29:29',
            'updated_at'=>'2020-03-20 07:29:29',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>20,
            'name'=>'VARIATOR',
            'slug'=>'variator',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>9,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-03-20 07:30:21',
            'updated_at'=>'2020-03-20 07:30:21',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>21,
            'name'=>'CYCLO GEAR',
            'slug'=>'cyclo_gear',
            'image'=>'sumitomo cvvm.jpg',
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-11-01 11:08:05',
            'updated_at'=>'2020-11-01 11:08:05',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>23,
            'name'=>'Mymex',
            'slug'=>'mymex',
            'image'=>'Mymex Penang Logo.JPG',
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-11-16 15:33:14',
            'updated_at'=>'2020-11-16 15:33:14',
            'deleted_at'=>'2020-11-16 15:33:14'
        ] );



        ProductCategory::create( [
            'id'=>26,
            'name'=>'Air Compressor',
            'slug'=>'air_compressor',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 19:54:14',
            'updated_at'=>'2020-12-20 19:59:57',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>27,
            'name'=>'Air Cleaning & Purifying Equipment',
            'slug'=>'air_cleaning_&_purifying_equipment',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 19:56:50',
            'updated_at'=>'2020-12-20 20:20:09',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>28,
            'name'=>'Air Conditioning',
            'slug'=>'air_conditioning',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 19:57:04',
            'updated_at'=>'2020-12-20 20:19:27',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>29,
            'name'=>'Air Motor',
            'slug'=>'air_motor',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 19:57:20',
            'updated_at'=>'2020-12-20 20:21:39',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>30,
            'name'=>'AIR POLLUTION SYSTEM',
            'slug'=>'air_pollution_system',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 20:28:33',
            'updated_at'=>'2020-12-20 20:28:33',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>31,
            'name'=>'ALARM SYSTEMS',
            'slug'=>'alarm_systems',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 20:28:55',
            'updated_at'=>'2020-12-20 20:28:55',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>32,
            'name'=>'ALUMINIUM PRODUCTS',
            'slug'=>'aluminium_products',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 20:29:17',
            'updated_at'=>'2020-12-20 20:29:17',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>33,
            'name'=>'BEARING',
            'slug'=>'bearing',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 20:29:40',
            'updated_at'=>'2020-12-20 20:29:40',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>34,
            'name'=>'BLASTING EQUIPMENT',
            'slug'=>'blasting_equipment',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 20:29:59',
            'updated_at'=>'2020-12-20 20:29:59',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>35,
            'name'=>'BOILER CONTROL SYSTEM',
            'slug'=>'boiler_control_system',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 20:30:12',
            'updated_at'=>'2020-12-20 20:30:12',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>36,
            'name'=>'BRUSHES-INDUSTRIAL',
            'slug'=>'brushes-industrial',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 20:30:26',
            'updated_at'=>'2020-12-20 20:30:26',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>37,
            'name'=>'BURNER',
            'slug'=>'burner',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 20:30:38',
            'updated_at'=>'2020-12-20 20:30:38',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>38,
            'name'=>'COOLING TOWER',
            'slug'=>'cooling_tower',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 20:30:51',
            'updated_at'=>'2020-12-20 20:30:51',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>39,
            'name'=>'DRIVES CONTROLLER',
            'slug'=>'drives_controller',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 20:42:19',
            'updated_at'=>'2020-12-20 20:42:19',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>40,
            'name'=>'ELECTRIC INSTRUMENTS',
            'slug'=>'electric_instruments',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 20:44:56',
            'updated_at'=>'2020-12-20 20:44:56',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>41,
            'name'=>'ELECTRIC MOTOR',
            'slug'=>'electric_motor',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 20:45:10',
            'updated_at'=>'2020-12-20 20:45:10',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>42,
            'name'=>'ELECTRICAL & WIRING',
            'slug'=>'electrical_&_wiring',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 20:45:27',
            'updated_at'=>'2020-12-20 20:45:27',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>43,
            'name'=>'ELECTRONIC PARTS',
            'slug'=>'electronic_parts',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 20:45:57',
            'updated_at'=>'2020-12-20 20:45:57',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>44,
            'name'=>'FAN & BLOWER',
            'slug'=>'fan_&_blower',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 20:46:16',
            'updated_at'=>'2020-12-20 20:46:16',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>45,
            'name'=>'FASTENER',
            'slug'=>'fastener',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 20:46:32',
            'updated_at'=>'2020-12-20 20:46:32',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>46,
            'name'=>'FILTERS',
            'slug'=>'filters',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 20:46:45',
            'updated_at'=>'2020-12-20 20:46:45',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>47,
            'name'=>'FIRE FIGHTING EQUIPMENT',
            'slug'=>'fire_fighting_equipment',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 20:46:58',
            'updated_at'=>'2020-12-20 20:46:58',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>48,
            'name'=>'GAUGES',
            'slug'=>'gauges',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 20:47:11',
            'updated_at'=>'2020-12-20 20:47:11',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>49,
            'name'=>'GEAR REDUCER',
            'slug'=>'gear_reducer',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 20:47:59',
            'updated_at'=>'2020-12-20 20:47:59',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>50,
            'name'=>'HEATER',
            'slug'=>'heater',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 20:48:35',
            'updated_at'=>'2020-12-20 20:48:35',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>51,
            'name'=>'HOSE & TUBING',
            'slug'=>'hose_&_tubing',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 20:48:51',
            'updated_at'=>'2020-12-20 20:48:51',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>52,
            'name'=>'HYDRAULIC',
            'slug'=>'hydraulic',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 20:49:06',
            'updated_at'=>'2020-12-20 20:49:06',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>53,
            'name'=>'INDUSTRIAL PC',
            'slug'=>'industrial_pc',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 20:57:53',
            'updated_at'=>'2020-12-20 20:57:53',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>54,
            'name'=>'INSTRUMENT EQUIPMENT',
            'slug'=>'instrument_equipment',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 20:58:07',
            'updated_at'=>'2020-12-20 20:58:07',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>55,
            'name'=>'INSULATION MATERIAL',
            'slug'=>'insulation_material',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 20:59:18',
            'updated_at'=>'2020-12-20 20:59:18',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>56,
            'name'=>'LABELLING EQUIPMENT',
            'slug'=>'labelling_equipment',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 20:59:31',
            'updated_at'=>'2020-12-20 20:59:31',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>57,
            'name'=>'LABORATARY EQUIPMENT',
            'slug'=>'laboratary_equipment',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 20:59:42',
            'updated_at'=>'2020-12-20 20:59:42',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>58,
            'name'=>'MATERIAL HANDLING EQUIPMENT',
            'slug'=>'material_handling_equipment',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 20:59:52',
            'updated_at'=>'2020-12-20 20:59:52',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>59,
            'name'=>'OIL GAS EQUIPMENT',
            'slug'=>'oil_gas_equipment',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:00:07',
            'updated_at'=>'2020-12-20 21:00:07',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>60,
            'name'=>'PEST CONTROL',
            'slug'=>'pest_control',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:00:21',
            'updated_at'=>'2020-12-20 21:00:21',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>61,
            'name'=>'PHOTO COPYING MACHINE',
            'slug'=>'photo_copying_machine',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:00:32',
            'updated_at'=>'2020-12-20 21:00:32',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>62,
            'name'=>'PIPES & FITTING',
            'slug'=>'pipes_&_fitting',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:00:42',
            'updated_at'=>'2020-12-20 21:00:42',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>63,
            'name'=>'PLASTIC PRODUCTS(NYLON, PVC)',
            'slug'=>'plastic_products(nylon,_pvc)',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:00:56',
            'updated_at'=>'2020-12-20 21:00:56',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>64,
            'name'=>'PNEUMATIC',
            'slug'=>'pneumatic',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:01:08',
            'updated_at'=>'2020-12-20 21:01:08',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>65,
            'name'=>'POWER TRANSMISSION PARTS',
            'slug'=>'power_transmission_parts',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:01:21',
            'updated_at'=>'2020-12-20 21:01:21',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>66,
            'name'=>'PUMP',
            'slug'=>'pump',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:01:33',
            'updated_at'=>'2020-12-20 21:01:33',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>67,
            'name'=>'RADIATOR',
            'slug'=>'radiator',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:01:46',
            'updated_at'=>'2020-12-20 21:01:46',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>68,
            'name'=>'REFRIGERATION EQUIPMENT',
            'slug'=>'refrigeration_equipment',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:01:57',
            'updated_at'=>'2020-12-20 21:01:57',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>69,
            'name'=>'SAFETY EQUIPMENT',
            'slug'=>'safety_equipment',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:02:09',
            'updated_at'=>'2020-12-20 21:02:09',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>70,
            'name'=>'SEALS',
            'slug'=>'seals',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:03:08',
            'updated_at'=>'2020-12-20 21:03:08',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>71,
            'name'=>'SEWAGE TREATMENT EQUIPMENT',
            'slug'=>'sewage_treatment_equipment',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:03:22',
            'updated_at'=>'2020-12-20 21:03:22',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>72,
            'name'=>'SPRAYING EQUIPMENT',
            'slug'=>'spraying_equipment',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:03:34',
            'updated_at'=>'2020-12-20 21:03:34',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>73,
            'name'=>'STAINLESS STEEL PRODUCTS',
            'slug'=>'stainless_steel_products',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:03:45',
            'updated_at'=>'2020-12-20 21:03:45',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>74,
            'name'=>'STEEL PRODUCTS',
            'slug'=>'steel_products',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:04:00',
            'updated_at'=>'2020-12-20 21:04:00',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>75,
            'name'=>'TOOLS & EQUIPMENT',
            'slug'=>'tools_&_equipment',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:04:12',
            'updated_at'=>'2020-12-20 21:04:12',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>76,
            'name'=>'VIBRATORION SYSTEM',
            'slug'=>'vibratorion_system',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:04:27',
            'updated_at'=>'2020-12-20 21:04:27',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>77,
            'name'=>'WASTE WATER TREATMENT',
            'slug'=>'waste_water_treatment',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:04:38',
            'updated_at'=>'2020-12-20 21:04:38',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>78,
            'name'=>'VALVE',
            'slug'=>'valve',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:04:49',
            'updated_at'=>'2020-12-20 21:04:49',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>79,
            'name'=>'X-RAY EQUIPMENT',
            'slug'=>'x-ray_equipment',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:05:04',
            'updated_at'=>'2020-12-20 21:05:04',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>80,
            'name'=>'AXIAL COMPRESSOR',
            'slug'=>'axial_compressor',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>26,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:05:33',
            'updated_at'=>'2020-12-20 21:05:33',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>81,
            'name'=>'CENTRIFUGAL COMPRESSOR',
            'slug'=>'centrifugal_compressor',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>26,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:05:48',
            'updated_at'=>'2020-12-20 21:05:48',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>82,
            'name'=>'RECIPROCATING AIR COMPRESSOR',
            'slug'=>'reciprocating_air_compressor',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>26,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:07:47',
            'updated_at'=>'2020-12-20 21:07:47',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>83,
            'name'=>'ROTARY SCREW COMPRESSOR',
            'slug'=>'rotary_screw_compressor',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>26,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:08:07',
            'updated_at'=>'2020-12-20 21:08:07',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>84,
            'name'=>'CEILING CASSETTE AIR CONDITIONER',
            'slug'=>'ceiling_cassette_air_conditioner',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>28,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:14:01',
            'updated_at'=>'2020-12-20 21:14:01',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>85,
            'name'=>'PORTABLE AIR CONDITIONER',
            'slug'=>'portable_air_conditioner',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>28,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:14:22',
            'updated_at'=>'2020-12-20 21:14:22',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>86,
            'name'=>'SPLIT UNIT AIR CONDITIONER',
            'slug'=>'split_unit_air_conditioner',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>28,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:17:50',
            'updated_at'=>'2020-12-20 21:17:50',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>87,
            'name'=>'ALUMINIUM ORNAMENTAL',
            'slug'=>'aluminium_ornamental',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>32,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:18:14',
            'updated_at'=>'2020-12-20 21:18:14',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>88,
            'name'=>'ALUMINIUM PROFILE',
            'slug'=>'aluminium_profile',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>NULL,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:19:21',
            'updated_at'=>'2020-12-20 21:19:21',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>89,
            'name'=>'BALL BEARING',
            'slug'=>'ball_bearing',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>33,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:19:40',
            'updated_at'=>'2020-12-20 21:19:40',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>90,
            'name'=>'LINEAR BEARING',
            'slug'=>'linear_bearing',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>33,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:19:57',
            'updated_at'=>'2020-12-20 21:19:57',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>91,
            'name'=>'NEEDLE BEARING',
            'slug'=>'needle_bearing',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>33,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:20:18',
            'updated_at'=>'2020-12-20 21:20:18',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>92,
            'name'=>'ROLLER BEARING',
            'slug'=>'roller_bearing',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>33,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:20:40',
            'updated_at'=>'2020-12-20 21:20:40',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>93,
            'name'=>'DIESEL BURNER',
            'slug'=>'diesel_burner',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>37,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:22:50',
            'updated_at'=>'2020-12-20 21:22:50',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>94,
            'name'=>'GAS BURNER',
            'slug'=>'gas_burner',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>37,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:23:09',
            'updated_at'=>'2020-12-20 21:23:09',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>95,
            'name'=>'AC INVERTER',
            'slug'=>'ac_inverter',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>39,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:23:30',
            'updated_at'=>'2020-12-20 21:23:30',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>96,
            'name'=>'AC SERVO DRIVES',
            'slug'=>'ac_servo_drives',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>39,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:23:46',
            'updated_at'=>'2020-12-20 21:23:46',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>97,
            'name'=>'DC DRIVES',
            'slug'=>'dc_drives',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>39,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:24:08',
            'updated_at'=>'2020-12-20 21:24:08',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>98,
            'name'=>'DC SERVO DRIVES',
            'slug'=>'dc_servo_drives',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>39,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:24:27',
            'updated_at'=>'2020-12-20 21:24:27',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>99,
            'name'=>'SOFT STARTER',
            'slug'=>'soft_starter',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>39,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:24:44',
            'updated_at'=>'2020-12-20 21:24:44',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>100,
            'name'=>'VS CONTROLLER',
            'slug'=>'vs_controller',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>39,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:24:59',
            'updated_at'=>'2020-12-20 21:24:59',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>101,
            'name'=>'ENCODERS',
            'slug'=>'encoders',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>40,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:29:32',
            'updated_at'=>'2020-12-20 21:29:32',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>102,
            'name'=>'LOAD CELL',
            'slug'=>'load_cell',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>40,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:29:54',
            'updated_at'=>'2020-12-20 21:29:54',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>103,
            'name'=>'PH METER',
            'slug'=>'ph_meter',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>40,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:30:10',
            'updated_at'=>'2020-12-20 21:30:10',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>104,
            'name'=>'PRESSURE TRANSMITTER',
            'slug'=>'pressure_transmitter',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>40,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:30:27',
            'updated_at'=>'2020-12-20 21:30:27',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>105,
            'name'=>'RECORDERS',
            'slug'=>'recorders',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>40,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:31:00',
            'updated_at'=>'2020-12-20 21:31:00',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>106,
            'name'=>'SENSORS',
            'slug'=>'sensors',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>40,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:31:21',
            'updated_at'=>'2020-12-20 21:31:21',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>107,
            'name'=>'THERMO COUPLE',
            'slug'=>'thermo_couple',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>40,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:31:37',
            'updated_at'=>'2020-12-20 21:31:37',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>108,
            'name'=>'VISION CONTROLS',
            'slug'=>'vision_controls',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>40,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:31:52',
            'updated_at'=>'2020-12-20 21:31:52',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>109,
            'name'=>'AC INDUCTION MOTOR',
            'slug'=>'ac_induction_motor',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>41,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:32:08',
            'updated_at'=>'2020-12-20 21:32:08',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>110,
            'name'=>'AC SERVO MOTOR',
            'slug'=>'ac_servo_motor',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>41,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:32:23',
            'updated_at'=>'2020-12-20 21:32:23',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>111,
            'name'=>'DC MOTOR',
            'slug'=>'dc_motor',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>40,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:32:42',
            'updated_at'=>'2020-12-20 21:32:42',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>112,
            'name'=>'DC SERVO MOTOR',
            'slug'=>'dc_servo_motor',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>41,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:32:59',
            'updated_at'=>'2020-12-20 21:32:59',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>113,
            'name'=>'FRACTIONAL HORSEPOWER MOTOR',
            'slug'=>'fractional_horsepower_motor',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>41,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:33:12',
            'updated_at'=>'2020-12-20 21:33:12',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>114,
            'name'=>'MEDIUM VOLTAGE MOTOR',
            'slug'=>'medium_voltage_motor',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>41,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:33:27',
            'updated_at'=>'2020-12-20 21:33:27',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>115,
            'name'=>'PERMANENT MAGNET MOTOR',
            'slug'=>'permanent_magnet_motor',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>41,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:33:41',
            'updated_at'=>'2020-12-20 21:33:41',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>117,
            'name'=>'SLIP RING MOTOR',
            'slug'=>'slip_ring_motor',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>41,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:36:20',
            'updated_at'=>'2020-12-20 21:36:20',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>118,
            'name'=>'VARIABLE SPEED MOTOR',
            'slug'=>'variable_speed_motor',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>41,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:36:35',
            'updated_at'=>'2020-12-20 21:36:35',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>119,
            'name'=>'CABLEVEYOR',
            'slug'=>'cableveyor',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>42,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:40:32',
            'updated_at'=>'2020-12-20 21:40:32',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>120,
            'name'=>'CIRCUIT BREAKERS',
            'slug'=>'circuit_breakers',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>42,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:40:59',
            'updated_at'=>'2020-12-20 21:40:59',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>121,
            'name'=>'CONTACTORS',
            'slug'=>'contactors',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>42,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:42:29',
            'updated_at'=>'2020-12-20 21:42:29',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>122,
            'name'=>'ELECTRICAL CONDUIT AND CONDUIT FITTING',
            'slug'=>'electrical_conduit_and_conduit_fitting',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>42,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:42:44',
            'updated_at'=>'2020-12-20 21:42:44',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>123,
            'name'=>'ELECTRICAL CONNECTOR',
            'slug'=>'electrical_connector',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>42,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:43:03',
            'updated_at'=>'2020-12-20 21:43:13',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>124,
            'name'=>'ELECTRICAL PANEL BOX',
            'slug'=>'electrical_panel_box',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>42,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:43:37',
            'updated_at'=>'2020-12-20 21:43:37',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>125,
            'name'=>'ELECTRICAL SWITCHES',
            'slug'=>'electrical_switches',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>42,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:44:10',
            'updated_at'=>'2020-12-20 21:44:10',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>126,
            'name'=>'ELECTRICAL WIRE & CABLE',
            'slug'=>'electrical_wire_&_cable',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>42,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:44:31',
            'updated_at'=>'2020-12-20 21:44:31',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>127,
            'name'=>'EXPLOSION PROOF ENCLOSURES',
            'slug'=>'explosion_proof_enclosures',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>42,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:44:46',
            'updated_at'=>'2020-12-20 21:44:46',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>128,
            'name'=>'LIGHTING & LIGHTING SYSTEMS',
            'slug'=>'lighting_&_lighting_systems',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>42,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:45:00',
            'updated_at'=>'2020-12-20 21:45:00',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>129,
            'name'=>'LUGS',
            'slug'=>'lugs',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>42,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:45:15',
            'updated_at'=>'2020-12-20 21:45:15',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>130,
            'name'=>'POWER SUPPLY & CHARGERS',
            'slug'=>'power_supply_&_chargers',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>42,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:46:10',
            'updated_at'=>'2020-12-20 21:46:10',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>131,
            'name'=>'RELAY',
            'slug'=>'relay',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>42,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:46:26',
            'updated_at'=>'2020-12-20 21:46:26',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>132,
            'name'=>'SOLDERING EQUIPMENTS',
            'slug'=>'soldering_equipments',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>42,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:46:48',
            'updated_at'=>'2020-12-20 21:46:48',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>133,
            'name'=>'TRANSDUCER',
            'slug'=>'transducer',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>42,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:47:03',
            'updated_at'=>'2020-12-20 21:47:03',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>134,
            'name'=>'CAPACITORS',
            'slug'=>'capacitors',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>43,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:47:22',
            'updated_at'=>'2020-12-20 21:47:22',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>135,
            'name'=>'DIODES',
            'slug'=>'diodes',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>43,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:47:39',
            'updated_at'=>'2020-12-20 21:47:39',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>136,
            'name'=>'PLC',
            'slug'=>'plc',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>43,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:47:54',
            'updated_at'=>'2020-12-20 21:47:54',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>137,
            'name'=>'RESISTORS',
            'slug'=>'resistors',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>43,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:48:09',
            'updated_at'=>'2020-12-20 21:48:09',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>138,
            'name'=>'THERMISTER',
            'slug'=>'thermister',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>42,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:48:29',
            'updated_at'=>'2020-12-20 21:48:29',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>139,
            'name'=>'TRANSISTORS',
            'slug'=>'transistors',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>43,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:48:45',
            'updated_at'=>'2020-12-20 21:48:45',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>140,
            'name'=>'AXIAL FAN',
            'slug'=>'axial_fan',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>44,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:49:02',
            'updated_at'=>'2020-12-20 21:49:02',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>141,
            'name'=>'BIFURGATED FAN',
            'slug'=>'bifurgated_fan',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>44,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:49:18',
            'updated_at'=>'2020-12-20 21:49:18',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>142,
            'name'=>'CENTRIFUGAL BLOWER',
            'slug'=>'centrifugal_blower',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>44,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:49:33',
            'updated_at'=>'2020-12-20 21:49:33',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>143,
            'name'=>'CENTRIFUGAL FAN',
            'slug'=>'centrifugal_fan',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>44,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:50:11',
            'updated_at'=>'2020-12-20 21:50:11',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>144,
            'name'=>'RING BLOWER',
            'slug'=>'ring_blower',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>44,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:50:33',
            'updated_at'=>'2020-12-20 21:50:33',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>145,
            'name'=>'ROTARY BLOWER',
            'slug'=>'rotary_blower',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>44,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:50:56',
            'updated_at'=>'2020-12-20 21:50:56',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>146,
            'name'=>'SIRROCO BLOWER',
            'slug'=>'sirroco_blower',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>44,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:51:18',
            'updated_at'=>'2020-12-20 21:51:18',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>147,
            'name'=>'TURBO BLOWER',
            'slug'=>'turbo_blower',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>44,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:51:35',
            'updated_at'=>'2020-12-20 21:51:35',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>148,
            'name'=>'VACCUM BLOWER',
            'slug'=>'vaccum_blower',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>44,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:51:57',
            'updated_at'=>'2020-12-20 21:51:57',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>149,
            'name'=>'ANCHORS',
            'slug'=>'anchors',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>45,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:52:40',
            'updated_at'=>'2020-12-20 21:52:40',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>150,
            'name'=>'CABLE TIES',
            'slug'=>'cable_ties',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>45,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:52:56',
            'updated_at'=>'2020-12-20 21:52:56',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>151,
            'name'=>'HOOKS',
            'slug'=>'hooks',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>45,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:53:11',
            'updated_at'=>'2020-12-20 21:53:11',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>152,
            'name'=>'NAILS & STAPLES',
            'slug'=>'nails_&_staples',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>45,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:53:24',
            'updated_at'=>'2020-12-20 21:53:24',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>153,
            'name'=>'NUTS',
            'slug'=>'nuts',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>45,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:53:41',
            'updated_at'=>'2020-12-20 21:53:41',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>154,
            'name'=>'PINS',
            'slug'=>'pins',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>45,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:53:59',
            'updated_at'=>'2020-12-20 21:53:59',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>155,
            'name'=>'RETAINING RINGS',
            'slug'=>'retaining_rings',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>45,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:54:13',
            'updated_at'=>'2020-12-20 21:54:13',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>156,
            'name'=>'RIVETS',
            'slug'=>'rivets',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>45,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:54:28',
            'updated_at'=>'2020-12-20 21:54:28',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>157,
            'name'=>'SCREW & BOLTS',
            'slug'=>'screw_&_bolts',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>45,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:54:42',
            'updated_at'=>'2020-12-20 21:54:42',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>158,
            'name'=>'SEALANT',
            'slug'=>'sealant',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>45,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:54:56',
            'updated_at'=>'2020-12-20 21:54:56',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>159,
            'name'=>'STRUTS & ACCESSORIES',
            'slug'=>'struts_&_accessories',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>45,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:55:10',
            'updated_at'=>'2020-12-20 21:55:10',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>160,
            'name'=>'STUDS',
            'slug'=>'studs',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>45,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:55:25',
            'updated_at'=>'2020-12-20 21:55:25',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>161,
            'name'=>'THREAD INSERTS',
            'slug'=>'thread_inserts',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>45,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:55:39',
            'updated_at'=>'2020-12-20 21:55:39',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>162,
            'name'=>'THREADED RODS & KEYSTOCK',
            'slug'=>'threaded_rods_&_keystock',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>45,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:55:55',
            'updated_at'=>'2020-12-20 21:55:55',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>163,
            'name'=>'WASHER',
            'slug'=>'washer',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>45,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:56:13',
            'updated_at'=>'2020-12-20 21:56:13',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>164,
            'name'=>'AIR FILTERS',
            'slug'=>'air_filters',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>46,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:56:30',
            'updated_at'=>'2020-12-20 21:56:30',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>165,
            'name'=>'OIL FILTERS',
            'slug'=>'oil_filters',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>46,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:58:27',
            'updated_at'=>'2020-12-20 21:58:27',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>166,
            'name'=>'WATER FILTERS',
            'slug'=>'water_filters',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>46,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:58:52',
            'updated_at'=>'2020-12-20 21:58:52',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>167,
            'name'=>'FIRE EXTINGUISHER',
            'slug'=>'fire_extinguisher',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>47,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:59:32',
            'updated_at'=>'2020-12-20 21:59:32',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>168,
            'name'=>'FIRE FIGHTING HOSE REELS',
            'slug'=>'fire_fighting_hose_reels',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>47,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 21:59:46',
            'updated_at'=>'2020-12-20 21:59:46',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>169,
            'name'=>'FIRE FIGHTING HYDRANT SYSTEMS',
            'slug'=>'fire_fighting_hydrant_systems',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>47,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 22:00:02',
            'updated_at'=>'2020-12-20 22:00:02',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>170,
            'name'=>'FIRE FIGHTING SPRINKLERS',
            'slug'=>'fire_fighting_sprinklers',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>47,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 22:00:18',
            'updated_at'=>'2020-12-20 22:00:18',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>171,
            'name'=>'MEASURING GAUGES',
            'slug'=>'measuring_gauges',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>48,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 22:00:35',
            'updated_at'=>'2020-12-20 22:00:35',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>172,
            'name'=>'PRESSURE GAUGES',
            'slug'=>'pressure_gauges',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>48,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 22:00:51',
            'updated_at'=>'2020-12-20 22:00:51',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>173,
            'name'=>'CYCLO DRIVE GEARBOX',
            'slug'=>'cyclo_drive_gearbox',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>49,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 22:02:27',
            'updated_at'=>'2020-12-20 22:02:27',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>174,
            'name'=>'HELICAL BEVEL GEARBOX',
            'slug'=>'helical_bevel_gearbox',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>49,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 22:02:46',
            'updated_at'=>'2020-12-20 22:02:46',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>175,
            'name'=>'HELICAL GEARBOX',
            'slug'=>'helical_gearbox',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>49,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 22:03:02',
            'updated_at'=>'2020-12-20 22:03:02',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>176,
            'name'=>'HELICAL WORM GEARBOX',
            'slug'=>'helical_worm_gearbox',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>49,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 22:03:16',
            'updated_at'=>'2020-12-20 22:03:16',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>177,
            'name'=>'MECHANICAL VARIATOR',
            'slug'=>'mechanical_variator',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>49,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 22:03:30',
            'updated_at'=>'2020-12-20 22:03:30',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>178,
            'name'=>'PARALLEL SHAFT GEARBOX',
            'slug'=>'parallel_shaft_gearbox',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>49,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 22:03:44',
            'updated_at'=>'2020-12-20 22:03:44',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>179,
            'name'=>'PLANETARY GEARBOX',
            'slug'=>'planetary_gearbox',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>49,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 22:03:59',
            'updated_at'=>'2020-12-20 22:03:59',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>180,
            'name'=>'WORM GEARBOX',
            'slug'=>'worm_gearbox',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>49,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 22:04:14',
            'updated_at'=>'2020-12-20 22:04:14',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>181,
            'name'=>'BAND HEATER',
            'slug'=>'band_heater',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>50,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 22:04:50',
            'updated_at'=>'2020-12-20 22:04:50',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>182,
            'name'=>'DUCT HEATER',
            'slug'=>'duct_heater',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>50,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 22:05:06',
            'updated_at'=>'2020-12-20 22:05:06',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>183,
            'name'=>'HEAT EXCHANGER',
            'slug'=>'heat_exchanger',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>50,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 22:05:23',
            'updated_at'=>'2020-12-20 22:05:23',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>184,
            'name'=>'INDUCTION HEATER',
            'slug'=>'induction_heater',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>50,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 22:05:43',
            'updated_at'=>'2020-12-20 22:05:43',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>185,
            'name'=>'INFRARED HEATER',
            'slug'=>'infrared_heater',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>50,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 22:05:59',
            'updated_at'=>'2020-12-20 22:05:59',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>186,
            'name'=>'TUBULAR HEATER',
            'slug'=>'tubular_heater',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>50,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 22:06:13',
            'updated_at'=>'2020-12-20 22:06:13',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>187,
            'name'=>'BEVERAGE HOSE',
            'slug'=>'beverage_hose',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>51,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:02:08',
            'updated_at'=>'2020-12-20 23:02:08',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>188,
            'name'=>'HOSE FITTING',
            'slug'=>'hose_fitting',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>51,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:02:29',
            'updated_at'=>'2020-12-20 23:02:29',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>189,
            'name'=>'HYDRAULIC HOSE',
            'slug'=>'hydraulic_hose',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>51,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:02:45',
            'updated_at'=>'2020-12-20 23:02:45',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>190,
            'name'=>'PNEUMATIC HOSE',
            'slug'=>'pneumatic_hose',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>51,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:03:04',
            'updated_at'=>'2020-12-20 23:03:04',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>191,
            'name'=>'POLY PIPE',
            'slug'=>'poly_pipe',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>51,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:03:17',
            'updated_at'=>'2020-12-20 23:03:17',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>192,
            'name'=>'POLYURETHANE HOSE',
            'slug'=>'polyurethane_hose',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>51,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:05:09',
            'updated_at'=>'2020-12-20 23:05:09',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>193,
            'name'=>'PVC PIPE',
            'slug'=>'pvc_pipe',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>51,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:05:25',
            'updated_at'=>'2020-12-20 23:05:25',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>194,
            'name'=>'SILICONE HOSE',
            'slug'=>'silicone_hose',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>51,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:05:39',
            'updated_at'=>'2020-12-20 23:05:39',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>195,
            'name'=>'TYGON HOSE',
            'slug'=>'tygon_hose',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>51,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:05:55',
            'updated_at'=>'2020-12-20 23:05:55',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>196,
            'name'=>'WIRE REINFORCED HOSE',
            'slug'=>'wire_reinforced_hose',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>51,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:06:09',
            'updated_at'=>'2020-12-20 23:06:09',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>197,
            'name'=>'HYDRAULIC CYLINDER',
            'slug'=>'hydraulic_cylinder',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>52,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:06:29',
            'updated_at'=>'2020-12-20 23:06:29',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>198,
            'name'=>'HYDRAULIC PISTONS',
            'slug'=>'hydraulic_pistons',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>52,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:06:49',
            'updated_at'=>'2020-12-20 23:06:49',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>199,
            'name'=>'HYDRAULIC POWER PACK',
            'slug'=>'hydraulic_power_pack',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>52,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:07:06',
            'updated_at'=>'2020-12-20 23:07:06',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>200,
            'name'=>'HYDRAULIC VALVE',
            'slug'=>'hydraulic_valve',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>52,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:07:24',
            'updated_at'=>'2020-12-20 23:07:24',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>201,
            'name'=>'TOUCH SCREEN',
            'slug'=>'touch_screen',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>53,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:07:44',
            'updated_at'=>'2020-12-20 23:07:44',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>202,
            'name'=>'CONVEYOR',
            'slug'=>'conveyor',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>58,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:08:01',
            'updated_at'=>'2020-12-20 23:08:01',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>203,
            'name'=>'FORKLIFTS',
            'slug'=>'forklifts',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>58,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:08:18',
            'updated_at'=>'2020-12-20 23:08:18',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>204,
            'name'=>'HOIST & CRANE',
            'slug'=>'hoist_&_crane',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>58,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:08:37',
            'updated_at'=>'2020-12-20 23:08:37',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>205,
            'name'=>'PALLET TRUCK',
            'slug'=>'pallet_truck',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>58,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:08:54',
            'updated_at'=>'2020-12-20 23:08:54',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>206,
            'name'=>'RACKING SYSTEM',
            'slug'=>'racking_system',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>58,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:09:13',
            'updated_at'=>'2020-12-20 23:09:13',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>207,
            'name'=>'STORAGE SYSTEM',
            'slug'=>'storage_system',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>58,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:09:28',
            'updated_at'=>'2020-12-20 23:09:28',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>208,
            'name'=>'PIPE ADAPTORS',
            'slug'=>'pipe_adaptors',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>62,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:09:49',
            'updated_at'=>'2020-12-20 23:09:49',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>209,
            'name'=>'PIPE COUPLING',
            'slug'=>'pipe_coupling',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>62,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:10:05',
            'updated_at'=>'2020-12-20 23:10:05',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>210,
            'name'=>'PIPE CROSS',
            'slug'=>'pipe_cross',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>62,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:10:21',
            'updated_at'=>'2020-12-20 23:10:21',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>211,
            'name'=>'PIPE ELBOW',
            'slug'=>'pipe_elbow',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>62,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:10:38',
            'updated_at'=>'2020-12-20 23:10:38',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>212,
            'name'=>'PIPE OLET',
            'slug'=>'pipe_olet',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>62,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:10:58',
            'updated_at'=>'2020-12-20 23:10:58',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>213,
            'name'=>'PIPE REDUCER',
            'slug'=>'pipe_reducer',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>62,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:11:12',
            'updated_at'=>'2020-12-20 23:11:12',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>214,
            'name'=>'PIPE TEE',
            'slug'=>'pipe_tee',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>62,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:11:31',
            'updated_at'=>'2020-12-20 23:11:31',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>215,
            'name'=>'PIPE UNIONS',
            'slug'=>'pipe_unions',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>62,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:11:53',
            'updated_at'=>'2020-12-20 23:11:53',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>216,
            'name'=>'COPPER PIPES',
            'slug'=>'copper_pipes',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>62,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:12:10',
            'updated_at'=>'2020-12-20 23:12:10',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>217,
            'name'=>'GALVANIZED PIPES',
            'slug'=>'galvanized_pipes',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>62,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:12:20',
            'updated_at'=>'2020-12-20 23:13:27',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>218,
            'name'=>'POLYVINYL CHLORIDE PIPES',
            'slug'=>'polyvinyl_chloride_pipes',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>62,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:13:45',
            'updated_at'=>'2020-12-20 23:13:45',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>219,
            'name'=>'PVC PIPES',
            'slug'=>'pvc_pipes',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>62,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:14:03',
            'updated_at'=>'2020-12-20 23:14:03',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>220,
            'name'=>'PNEUMATIC HOSE & TUBING',
            'slug'=>'pneumatic_hose_&_tubing',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>64,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:16:44',
            'updated_at'=>'2020-12-20 23:16:44',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>221,
            'name'=>'PNEUMATIC VALVE',
            'slug'=>'pneumatic_valve',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>64,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:17:04',
            'updated_at'=>'2020-12-20 23:17:04',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>222,
            'name'=>'CONVEYOR CHAIN',
            'slug'=>'conveyor_chain',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>65,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:18:19',
            'updated_at'=>'2020-12-20 23:18:19',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>223,
            'name'=>'COUPLING',
            'slug'=>'coupling',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>65,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:18:32',
            'updated_at'=>'2020-12-20 23:18:32',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>224,
            'name'=>'FLUID COUPLING',
            'slug'=>'fluid_coupling',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>65,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:18:58',
            'updated_at'=>'2020-12-20 23:18:58',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>225,
            'name'=>'GEARS',
            'slug'=>'gears',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>65,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:22:57',
            'updated_at'=>'2020-12-20 23:22:57',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>226,
            'name'=>'HUB',
            'slug'=>'hub',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>65,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:25:42',
            'updated_at'=>'2020-12-20 23:25:42',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>227,
            'name'=>'POLY V BELT',
            'slug'=>'poly_v_belt',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>65,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:26:22',
            'updated_at'=>'2020-12-20 23:26:22',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>228,
            'name'=>'PVC CONVEYOR BELT',
            'slug'=>'pvc_conveyor_belt',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>65,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:26:41',
            'updated_at'=>'2020-12-20 23:26:41',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>229,
            'name'=>'ROLLER CHAIN',
            'slug'=>'roller_chain',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>65,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:27:01',
            'updated_at'=>'2020-12-20 23:27:01',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>230,
            'name'=>'ROUND BELT',
            'slug'=>'round_belt',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>65,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:27:18',
            'updated_at'=>'2020-12-20 23:27:18',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>231,
            'name'=>'RUBBER CONVEYOR BELT',
            'slug'=>'rubber_conveyor_belt',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>65,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:27:39',
            'updated_at'=>'2020-12-20 23:27:39',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>232,
            'name'=>'SPROCKET',
            'slug'=>'sprocket',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>65,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:28:06',
            'updated_at'=>'2020-12-20 23:28:06',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>233,
            'name'=>'TABLE TOP CHAIN',
            'slug'=>'table_top_chain',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>65,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:28:22',
            'updated_at'=>'2020-12-20 23:28:22',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>234,
            'name'=>'TABLE TOP CHAIN SPROCKET',
            'slug'=>'table_top_chain_sprocket',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>65,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:28:41',
            'updated_at'=>'2020-12-20 23:28:41',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>235,
            'name'=>'TAPERLOCK PULLEY',
            'slug'=>'taperlock_pulley',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>65,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:29:04',
            'updated_at'=>'2020-12-20 23:29:04',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>236,
            'name'=>'TIMING BELT',
            'slug'=>'timing_belt',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>65,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:29:23',
            'updated_at'=>'2020-12-20 23:29:23',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>237,
            'name'=>'TIMING PULLEY',
            'slug'=>'timing_pulley',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>65,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:29:41',
            'updated_at'=>'2020-12-20 23:29:41',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>238,
            'name'=>'TORQUE LIMITER',
            'slug'=>'torque_limiter',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>65,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:29:58',
            'updated_at'=>'2020-12-20 23:29:58',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>239,
            'name'=>'VEE BELT',
            'slug'=>'vee_belt',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>65,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:30:14',
            'updated_at'=>'2020-12-20 23:30:14',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>240,
            'name'=>'VEE PULLEY',
            'slug'=>'vee_pulley',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>65,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:30:33',
            'updated_at'=>'2020-12-20 23:30:33',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>241,
            'name'=>'BOOSTER PUMP',
            'slug'=>'booster_pump',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>66,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:31:55',
            'updated_at'=>'2020-12-20 23:31:55',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>242,
            'name'=>'CENTRIFUGAL PUMP',
            'slug'=>'centrifugal_pump',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>66,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:33:00',
            'updated_at'=>'2020-12-20 23:33:00',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>243,
            'name'=>'DIAPHRAGM PUMP',
            'slug'=>'diaphragm_pump',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>66,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:33:17',
            'updated_at'=>'2020-12-20 23:33:17',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>244,
            'name'=>'END SUCTION PUMP',
            'slug'=>'end_suction_pump',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>66,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:34:24',
            'updated_at'=>'2020-12-20 23:34:24',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>245,
            'name'=>'GEAR PUMP',
            'slug'=>'gear_pump',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>66,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:34:45',
            'updated_at'=>'2020-12-20 23:34:45',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>246,
            'name'=>'HORIZONTAL SPLIT CASE PUMP',
            'slug'=>'horizontal_split_case_pump',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>66,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:35:37',
            'updated_at'=>'2020-12-20 23:35:37',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>247,
            'name'=>'JET PUMP',
            'slug'=>'jet_pump',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>66,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:35:53',
            'updated_at'=>'2020-12-20 23:35:53',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>248,
            'name'=>'METERING PUMP',
            'slug'=>'metering_pump',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>66,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:36:10',
            'updated_at'=>'2020-12-20 23:36:10',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>249,
            'name'=>'MULTI STAGE PUMP',
            'slug'=>'multi_stage_pump',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>66,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:36:26',
            'updated_at'=>'2020-12-20 23:36:26',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>250,
            'name'=>'PISTON PUMP',
            'slug'=>'piston_pump',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>66,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:36:43',
            'updated_at'=>'2020-12-20 23:36:43',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>251,
            'name'=>'SCREW PUMP',
            'slug'=>'screw_pump',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>66,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:36:59',
            'updated_at'=>'2020-12-20 23:36:59',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>252,
            'name'=>'SELF PRIMING PUMP',
            'slug'=>'self_priming_pump',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>66,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:37:16',
            'updated_at'=>'2020-12-20 23:37:16',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>253,
            'name'=>'SLURRY PUMP',
            'slug'=>'slurry_pump',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>66,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:37:42',
            'updated_at'=>'2020-12-20 23:37:42',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>254,
            'name'=>'VANE PUMP',
            'slug'=>'vane_pump',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>66,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:37:57',
            'updated_at'=>'2020-12-20 23:37:57',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>255,
            'name'=>'WELL PUMP',
            'slug'=>'well_pump',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>66,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:38:15',
            'updated_at'=>'2020-12-20 23:38:15',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>256,
            'name'=>'EYE PROTECTION',
            'slug'=>'eye_protection',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>69,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:38:38',
            'updated_at'=>'2020-12-20 23:38:38',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>257,
            'name'=>'FEET PROTECTION',
            'slug'=>'feet_protection',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>69,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:38:53',
            'updated_at'=>'2020-12-20 23:38:53',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>258,
            'name'=>'FIRST-AID KIT',
            'slug'=>'first-aid_kit',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>69,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:39:05',
            'updated_at'=>'2020-12-20 23:39:05',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>259,
            'name'=>'HAND PROTECTION',
            'slug'=>'hand_protection',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>69,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:39:24',
            'updated_at'=>'2020-12-20 23:39:24',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>260,
            'name'=>'HEAD PROTECTION',
            'slug'=>'head_protection',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>69,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:39:36',
            'updated_at'=>'2020-12-20 23:39:36',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>261,
            'name'=>'HEARING PROTECTION',
            'slug'=>'hearing_protection',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>69,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:39:49',
            'updated_at'=>'2020-12-20 23:39:49',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>262,
            'name'=>'RESPIRATORY PROTECTION',
            'slug'=>'respiratory_protection',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>69,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:40:03',
            'updated_at'=>'2020-12-20 23:40:03',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>263,
            'name'=>'SAFETY CLOTHING',
            'slug'=>'safety_clothing',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>69,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:40:18',
            'updated_at'=>'2020-12-20 23:40:18',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>264,
            'name'=>'GASKET',
            'slug'=>'gasket',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>70,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:40:33',
            'updated_at'=>'2020-12-20 23:40:33',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>265,
            'name'=>'MECHANICAL SEAL',
            'slug'=>'mechanical_seal',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>70,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:40:51',
            'updated_at'=>'2020-12-20 23:40:51',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>266,
            'name'=>'O RING',
            'slug'=>'o_ring',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>70,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:41:07',
            'updated_at'=>'2020-12-20 23:41:07',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>267,
            'name'=>'OIL SEAL',
            'slug'=>'oil_seal',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>70,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:41:21',
            'updated_at'=>'2020-12-20 23:41:21',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>268,
            'name'=>'ABRASIVES',
            'slug'=>'abrasives',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>75,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:41:45',
            'updated_at'=>'2020-12-20 23:41:45',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>269,
            'name'=>'ADHESIVES',
            'slug'=>'adhesives',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>75,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:42:20',
            'updated_at'=>'2020-12-20 23:42:20',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>270,
            'name'=>'ALLEN KEYS',
            'slug'=>'allen_keys',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>75,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:48:29',
            'updated_at'=>'2020-12-20 23:48:29',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>271,
            'name'=>'APPAREL & SAFETY GEAR',
            'slug'=>'apparel_&_safety_gear',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>75,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:49:20',
            'updated_at'=>'2020-12-20 23:49:20',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>272,
            'name'=>'CNC MACHINES',
            'slug'=>'cnc_machines',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>75,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:49:36',
            'updated_at'=>'2020-12-20 23:49:36',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>273,
            'name'=>'CUTTING MACHINES',
            'slug'=>'cutting_machines',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>75,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:49:52',
            'updated_at'=>'2020-12-20 23:49:52',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>274,
            'name'=>'CUTTING TOOLS',
            'slug'=>'cutting_tools',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>75,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:50:08',
            'updated_at'=>'2020-12-20 23:50:08',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>275,
            'name'=>'DIE CUTTING TOOL',
            'slug'=>'die_cutting_tool',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>75,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:50:25',
            'updated_at'=>'2020-12-20 23:50:25',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>276,
            'name'=>'DRILLING EQUIPMENT',
            'slug'=>'drilling_equipment',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>75,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:50:40',
            'updated_at'=>'2020-12-20 23:50:40',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>277,
            'name'=>'DRIVBITSERT',
            'slug'=>'drivbitsert',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>75,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:50:55',
            'updated_at'=>'2020-12-20 23:50:55',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>278,
            'name'=>'ENGRAVING MACHINES & TOOLS',
            'slug'=>'engraving_machines_&_tools',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>75,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:51:13',
            'updated_at'=>'2020-12-20 23:51:13',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>279,
            'name'=>'GAUGES & MEASURING TOOLS',
            'slug'=>'gauges_&_measuring_tools',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>75,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:51:49',
            'updated_at'=>'2020-12-20 23:51:49',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>280,
            'name'=>'GRINDING MACHINERY',
            'slug'=>'grinding_machinery',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>75,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:52:04',
            'updated_at'=>'2020-12-20 23:52:04',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>281,
            'name'=>'HAND TOOLS',
            'slug'=>'hand_tools',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>75,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:52:21',
            'updated_at'=>'2020-12-20 23:52:21',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>282,
            'name'=>'JIGS & DIES',
            'slug'=>'jigs_&_dies',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>75,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:52:54',
            'updated_at'=>'2020-12-20 23:52:54',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>283,
            'name'=>'LATHE MACHINES',
            'slug'=>'lathe_machines',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>75,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:53:12',
            'updated_at'=>'2020-12-20 23:53:12',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>284,
            'name'=>'LUBRICANTS',
            'slug'=>'lubricants',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>75,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:53:28',
            'updated_at'=>'2020-12-20 23:53:28',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>285,
            'name'=>'METAL STAMPING MACHINES & TOOLS',
            'slug'=>'metal_stamping_machines_&_tools',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>75,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:53:44',
            'updated_at'=>'2020-12-20 23:53:44',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>286,
            'name'=>'MILLING MACHINES',
            'slug'=>'milling_machines',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>75,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:54:05',
            'updated_at'=>'2020-12-20 23:54:05',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>287,
            'name'=>'POWER TOOLS',
            'slug'=>'power_tools',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>75,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:54:23',
            'updated_at'=>'2020-12-20 23:54:23',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>288,
            'name'=>'WELDING',
            'slug'=>'welding',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>75,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:54:39',
            'updated_at'=>'2020-12-20 23:54:39',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>289,
            'name'=>'BALL VALVE',
            'slug'=>'ball_valve',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>78,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:55:00',
            'updated_at'=>'2020-12-20 23:55:00',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>290,
            'name'=>'BUTTERFLY VALVE',
            'slug'=>'butterfly_valve',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>78,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:55:17',
            'updated_at'=>'2020-12-20 23:55:17',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>291,
            'name'=>'CHECK VALVE',
            'slug'=>'check_valve',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>78,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:55:33',
            'updated_at'=>'2020-12-20 23:55:33',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>292,
            'name'=>'GATE VALVE',
            'slug'=>'gate_valve',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>78,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:55:49',
            'updated_at'=>'2020-12-20 23:55:49',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>293,
            'name'=>'GLOBE VALVE',
            'slug'=>'globe_valve',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>78,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:56:02',
            'updated_at'=>'2020-12-20 23:56:02',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>294,
            'name'=>'SAFETY VALVE',
            'slug'=>'safety_valve',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>78,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:56:15',
            'updated_at'=>'2020-12-20 23:56:15',
            'deleted_at'=>NULL
        ] );



        ProductCategory::create( [
            'id'=>295,
            'name'=>'SANITARY VALVE',
            'slug'=>'sanitary_valve',
            'image'=>NULL,
            'clicks'=>0,
            'parent_id'=>78,
            'position'=>0,
            'is_featured'=>0,
            'is_active'=>1,
            'created_at'=>'2020-12-20 23:56:34',
            'updated_at'=>'2020-12-20 23:56:34',
            'deleted_at'=>NULL
        ] );







    }
}
