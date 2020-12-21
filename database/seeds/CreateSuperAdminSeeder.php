<?php

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\AdminRole;

class CreateSuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $adminrole = AdminRole::create(['name' => 'Admin']);

        $admin = Admin::create([
            'name' => 'Jia Song',
            'username' => 'jiasong',
            'email' => 'jiasong23@gmail.com',
            'password' => bcrypt('admin123'),
            'admin_role_id' => $adminrole->id
        ]);

    }
}
