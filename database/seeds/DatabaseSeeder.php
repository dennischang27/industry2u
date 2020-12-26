<?php


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountryTableSeeder::class);
        $this->call(CountryStateTableSeeder::class);
        $this->call(BankTableSeeder::class);
        $this->call(IndustriesTableSeeder::class);
        $this->call(BrandTableSeeder::class);
        $this->call(DocTypeTableSeeder::class);
        $this->call(CurrencyTableSeeder::class);
        $this->call(PhoneCountriesTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(CreateAdminUserSeeder::class);
        $this->call(CreateSuperAdminUserSeeder::class);
        // $this->call(UsersTableSeeder::class);
    }
}
