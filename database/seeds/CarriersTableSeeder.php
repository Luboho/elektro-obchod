<?php

use App\Carrier;
use Illuminate\Database\Seeder;

class CarriersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Carrier::create([
            'name' => 'DHL',
            'slug' => 'dhl',
            'description' => 'Doručujeme denne od 8:00 do 18:00.',
            'price' => 455,
        ]);

        Carrier::create([
            'name' => 'Slovenská pošta',
            'slug' => 'slovenska-posta',
            'description' => 'Doručujeme rýchlo a každý deň.',
            'price' => 500,
        ]);
    }
}
