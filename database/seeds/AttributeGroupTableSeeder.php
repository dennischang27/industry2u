<?php

use Illuminate\Database\Seeder;
use App\Models\AttributeGroup;

class AttributeGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AttributeGroup::create( [
            'id'=>1,
            'name'=>'General',
            'slug'=>'general',
        ] );
    }
}
