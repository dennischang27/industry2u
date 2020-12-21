<?php

use Illuminate\Database\Seeder;
use App\Models\User;

use Spatie\Permission\Models\Role;

use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete'
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
