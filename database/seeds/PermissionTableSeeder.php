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
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'ir-list',
            'ir-create',
            'ir-edit',
            'ir-delete',
            'qr-list',
            'qr-create',
            'qr-edit',
            'qr-delete',
            'quotation-list',
            'quotation-create',
            'quotation-edit',
            'quotation-delete',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
