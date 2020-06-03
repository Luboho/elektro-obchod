<?php

namespace Tests\Feature;

use App\Product;
use App\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewShopPageTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function testExample()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
    public function test_shop_page_loads_correctly()
    {
    // Arrange    

    // Act
        $response = $this->get('/shop');    // Visit Shop page.

    // Assert
        $response->assertStatus(200);       // 200 successful request.
        $response->assertSee('Featured');  // If there is text in the page which is tested.;
    }

    /** @test */
    public function test_featured_product_is_visible()
    {
        // Arrange
        $featuredProduct = factory(Product::class)->create([
            'featured' => true,
            'name' => 'Laptop 1',
            'price' => 149999,
        ]);

         // Act
         $response = $this->get('/');

         // Assert
         $response->assertSee($featuredProduct->name);
         $response->assertSee('€1499.99');
    }


    /** @test */
    public function test_not_featured_product_is_not_visible()
    {
        // Arrange
        $notfeaturedProduct = factory(Product::class)->create([
            'featured' => false,
            'name' => 'Laptop 1',
            'price' => 149999,
        ]);

         // Act
         $response = $this->get('/');

         // Assert
         $response->assertDontSee($notfeaturedProduct->name);
         $response->assertDontSee('€1499.99');
    }

    /** @Test */
    public function test_pagination_for_products_works()
    {
        // Page 1 products
        for ($i=11; $i < 20 ; $i++) {
            factory(Product::class)->create([
                'featured' => true,
                'name' => 'Product '.$i,
            ]);
        }

        // Page 2 products
        for ($i=21; $i < 30 ; $i++) {
            factory(Product::class)->create([
                'featured' => true,
                'name' => 'Product '.$i,
            ]);
        }

        $response = $this->get('/shop');

        $response->assertSee('Product 11');
        $response->assertSee('Product 19');

        $response = $this->get('/shop?page=2');

        $response->assertSee('Product 21');
        $response->assertSee('Product 29');
    }

    /** @test */
    public function test_sort_price_low_to_high()
    {
        factory(Product::class)->create([
            'featured' => true,
            'name' => 'Product Middle',
            'price' => 15000,
        ]);

        factory(Product::class)->create([
            'featured' => true,
            'name' => 'Product Low',
            'price' => 10000,
        ]);

        factory(Product::class)->create([
            'featured' => true,
            'name' => 'Product High',
            'price' => 20000,
        ]);

        $response = $this->get('/shop?sort=low_high');

        $response->assertSeeinOrder(['Product Low', 'Product Middle', 'Product High']);
    }

    /** @test */
    public function test_sort_price_high_to_low()
    {
        factory(Product::class)->create([
            'featured' => true,
            'name' => 'Product Middle',
            'price' => 15000,
        ]);

        factory(Product::class)->create([
            'featured' => true,
            'name' => 'Product Low',
            'price' => 10000,
        ]);

        factory(Product::class)->create([
            'featured' => true,
            'name' => 'Product High',
            'price' => 20000,
        ]);

        $response = $this->get('/shop?sort=high_low');

        $response->assertSeeinOrder(['Product High', 'Product Middle', 'Product Low']);
    }

    /** @test */
    public function test_category_page_shows_correct_product()
    {
        $laptop1 = factory(Product::class)->create(['name' => 'Laptop 1']);
        $laptop2 = factory(Product::class)->create(['name' => 'Laptop 2']);

        $laptopsCategory = Category::create([
            'name' => 'laptops',
            'slug' => 'laptops',
        ]);

        $laptop1->categories()->attach($laptopsCategory->id);
        $laptop2->categories()->attach($laptopsCategory->id);

        $response = $this->get('/shop?category=laptops');

        $response->assertSee('Laptop 1');
        $response->assertSee('Laptop 2');
    }

    /** @test */
    public function test_category_page_does_not_show_products_in_another_category()
    {
        $laptop1 = factory(Product::class)->create(['name' => 'Laptop 1']);
        $laptop2 = factory(Product::class)->create(['name' => 'Laptop 2']);

        $laptopsCategory = Category::create([
            'name' => 'laptops',
            'slug' => 'laptops',
        ]);

        $laptop1->categories()->attach($laptopsCategory->id);
        $laptop2->categories()->attach($laptopsCategory->id);

        $desktop1 = factory(Product::class)->create(['name' => 'Desktop 1']);
        $desktop2 = factory(Product::class)->create(['name' => 'Desktop 2']);

        $desktopsCategory = Category::create([
            'name' => 'Desktops',
            'slug' => 'desktops',
        ]);

        $desktop1->categories()->attach($desktopsCategory->id);
        $desktop2->categories()->attach($desktopsCategory->id);

        $response = $this->get('/shop?category=laptops');

        $response->assertDontSee('Desktop 1');
        $response->assertDontSee('Desktop 2');
    }
}