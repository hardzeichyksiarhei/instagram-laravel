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
        $this->call(UsersTableSeeder::class);
        $this->call(CheatCategoriesTableSeeder::class);
        $this->call(PriceListsTableSeeder::class);
        $this->call(BillingsTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
    }
}
