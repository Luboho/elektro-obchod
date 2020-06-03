<?php

use App\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();

        Category::insert([
            ['name' => 'Notebooky', 'slug' => 'notebooky', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Počítače', 'slug' => 'pocitace', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Mobilné telefóny', 'slug' => 'mobilne-telefony', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Tablety', 'slug' => 'tablety', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Televízory', 'slug' => 'televizory', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Digitálne fotoaparáty', 'slug' => 'digitalne-fotoaparaty', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Spotrebiče', 'slug' => 'spotrebice', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
