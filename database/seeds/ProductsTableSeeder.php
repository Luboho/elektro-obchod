<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Laptops
        for($i = 1; $i <= 30; $i++) {
            Product::create([
                'name' => 'Notebook ' . $i,
                'slug' => 'notebook-' . $i,
                'details' => [13, 14, 15][array_rand([13, 14, 15])] . '", ' . [1, 2, 3][array_rand([1, 2, 3])] . ' TB SSD, 32GB RAM',
                'price' => rand(149999, 249999),
                'description' => 'Lorem' . $i . 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem in corporis
                                                    consectetur vero enim ab nisi eligendi error a.',
                'image' => 'products/dummy/laptop-'.$i.'.jpg',
                'images' => '["products\/dummy\/laptop-2.jpg","products\/dummy\/laptop-3.jpg","products\/dummy\/laptop-4.jpg"]',
             ])->categories()->attach(1);        // categories == relationship fnc. Product model.
        }

        $product = Product::find(1);        // MULTIPLAY categories. 1Laptop belongs to more than one category.
        $product->categories()->attach(2);

        // Desktops
        for($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'Počítač ' . $i,
                'slug' => 'pocitac-' . $i,
                'details' => [24, 25, 27][array_rand([24, 25, 27])] . '", ' . [1, 2, 3][array_rand([1, 2, 3])] . ' TB SSD, 32GB RAM',
                'price' => rand(249999, 449999),
                'description' => 'Lorem ' . $i . ' ipsum dolor sit amet consectetur adipisicing elit. Non exercitationem, voluptate esse
                                    voluptas inventore est? Quos, velit beatae. Provident, ut!',
                'image' => 'products/dummy/desktop-'.$i.'.jpg',
                'images' => '["products\/dummy\/laptop-2.jpg","products\/dummy\/laptop-3.jpg","products\/dummy\/laptop-4.jpg"]',
            ])->categories()->attach(2);        // categories == relationship fnc. in model
        }

        // Phones
        for($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'Mobilný telefón ' . $i,
                'slug' => 'mobilny-telefon- ' . $i,
                'details' => [16, 32, 64][array_rand([16, 32, 64])] . ' GB, 5 ' . [7, 8, 9][array_rand([7, 8, 9])] . '" display, 4GHz Quad Core',
                'price' => rand(79999, 149999),
                'description' => 'Lorem ' . $i . ' ipsum dolor sit amet consectetur adipisicing elit. Non exercitationem, voluptate esse
                                    voluptas inventore est? Quos, velit beatae. Provident, ut!',
                'image' => 'products/dummy/phone-'.$i.'.jpg',
                'images' => '["products\/dummy\/laptop-2.jpg","products\/dummy\/laptop-3.jpg","products\/dummy\/laptop-4.jpg"]',
            ])->categories()->attach(3);        // categories == relationship fnc. in model
        }

        // Tablets
        for($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'Tablety ' . $i,
                'slug' => 'tablety-' . $i,
                'details' => [16, 32, 64][array_rand([16, 32, 64])] . ' GB, 5 ' . [10, 11, 12][array_rand([10, 11, 12])] . '" display, 4GHz Quad Core',
                'price' => rand(49999, 149999),
                'description' => 'Lorem ' . $i . ' ipsum dolor sit amet consectetur adipisicing elit. Non exercitationem, voluptate esse
                                    voluptas inventore est? Quos, velit beatae. Provident, ut!',
                'image' => 'products/dummy/tablet-'.$i.'.jpg',
                'images' => '["products\/dummy\/laptop-2.jpg","products\/dummy\/laptop-3.jpg","products\/dummy\/laptop-4.jpg"]',
            ])->categories()->attach(4);        // categories == relationship fnc. in model
        }

            // TVs
            for($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'Televízory ' . $i,
                'slug' => 'televizory-' . $i,
                'details' => [46, 50, 60][array_rand([46, 50, 60])] . '" display, Smart TV, 4K',
                'price' => rand(79999, 149999),
                'description' => 'Lorem ' . $i . ' ipsum dolor sit amet consectetur adipisicing elit. Non exercitationem, voluptate esse
                                    voluptas inventore est? Quos, velit beatae. Provident, ut!',
                'image' => 'products/dummy/tv-'.$i.'.jpg',
                'images' => '["products\/dummy\/laptop-2.jpg","products\/dummy\/laptop-3.jpg","products\/dummy\/laptop-4.jpg"]',
            ])->categories()->attach(5);        // categories == relationship fnc. in model
        }


            // Cameras
            for($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'Fotoaparát ' . $i,
                'slug' => 'fotoaparat-' . $i,
                'details' => 'Full Frame DSLR, spolu s 18-55mm objektívom.',
                'price' => rand(79999, 249999),
                'description' => 'Lorem ' . $i . ' ipsum dolor sit amet consectetur adipisicing elit. Non exercitationem, voluptate esse
                                    voluptas inventore est? Quos, velit beatae. Provident, ut!',
                'image' => 'products/dummy/camera-'.$i.'.jpg',
                'images' => '["products\/dummy\/laptop-2.jpg","products\/dummy\/laptop-3.jpg","products\/dummy\/laptop-4.jpg"]',
            ])->categories()->attach(6);        // categories == relationship fnc. in model
        }

            // Appliances
            for($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'Spotrebiče ' . $i,
                'slug' => 'spotrebice-' . $i,
                'details' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Debitis, asperiores?',
                'price' => rand(79999, 149999),
                'description' => 'Lorem ' . $i . ' ipsum dolor sit amet consectetur adipisicing elit. Non exercitationem, voluptate esse
                                    voluptas inventore est? Quos, velit beatae. Provident, ut!',
                'image' => 'products/dummy/appliance-'.$i.'.jpg',
                'images' => '["products\/dummy\/laptop-2.jpg","products\/dummy\/laptop-3.jpg","products\/dummy\/laptop-4.jpg"]',
            ])->categories()->attach(7);        // categories == relationship fnc. in model
        }

        // Select random entries to be featured
        Product::whereIn('id', [1, 12, 22, 31, 41, 43, 47, 51, 53,61, 69, 73, 80])->update(['featured' => true]);


        // Product::create([
        //     'name' => 'MacBook Pro',
        //     'slug' => 'macbook-pro',
        //     'details' => '15 inch, 1TB SSD, 32GB RAM',
        //     'price' => 249999,
        //     'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
        // ]);

        // Product::create([
        //     'name' => 'Laptop 2',
        //     'slug' => 'laptop-2',
        //     'details' => '15 inch, 1TB SSD, 16GB RAM',
        //     'price' => 149999,
        //     'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
        // ]);

        // Product::create([
        //     'name' => 'Laptop 3',
        //     'slug' => 'laptop-3',
        //     'details' => '13 inch, 1TB SSD, 16GB RAM',
        //     'price' => 149999,
        //     'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
        // ]);

        // Product::create([
        //     'name' => 'Laptop 4',
        //     'slug' => 'laptop-4',
        //     'details' => '15 inch, 1TB SSD, 16GB RAM',
        //     'price' => 149999,
        //     'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
        // ]);

        // Product::create([
        //     'name' => 'Laptop 5',
        //     'slug' => 'laptop-5',
        //     'details' => '15 inch, 1TB SSD, 16GB RAM',
        //     'price' => 149999,
        //     'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
        // ]);

        // Product::create([
        //     'name' => 'Laptop 6',
        //     'slug' => 'laptop-6',
        //     'details' => '15 inch, 1TB SSD, 16GB RAM',
        //     'price' => 149999,
        //     'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
        // ]);

        // Product::create([
        //     'name' => 'Laptop 7',
        //     'slug' => 'laptop-7',
        //     'details' => '15 inch, 1TB SSD, 16GB RAM',
        //     'price' => 149999,
        //     'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
        // ]);

        // Product::create([
        //     'name' => 'Laptop 8',
        //     'slug' => 'laptop-8',
        //     'details' => '15 inch, 1TB SSD, 16GB RAM',
        //     'price' => 149999,
        //     'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
        // ]);

        // Product::create([
        //     'name' => 'Laptop 9',
        //     'slug' => 'laptop-9',
        //     'details' => '15 inch, 1TB SSD, 16GB RAM',
        //     'price' => 149999,
        //     'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
        // ]);
        
    }
}
