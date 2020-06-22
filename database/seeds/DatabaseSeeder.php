<?php

use Illuminate\Database\Seeder;
use App\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoryTableSeeder::class);// Be sure to put CategoriesTableSeder in front of ProductsTableSeeder.
        $this->call(ProductsTableSeeder::class);
        $this->call(CouponsTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(CarriersTableSeeder::class);

        // $this->call(VoyagerDatabaseSeeder::class);
        // $this->call(VoyagerDummyDatabaseSeeder::class);
    }
}
