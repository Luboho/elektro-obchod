<?php

namespace Tests\Feature;

use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewProductTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function test_can_view_product_details()
    {
        $product = factory(Product::class)->create([
            'name' => 'Laptop 1',
            'slug' => 'laptop-1',
            'details' => '15 inch, 2 TB SSD, 32GB RAM',
            'price' => 249999,
            'description' => 'This is a description for Laptop 1.',
        ]);

        $response = $this->get('/shop/'.$product->slug);

        $response->assertStatus(200);
        $response->assertSee('Laptop 1');
        $response->assertSee('2 TB SSD');
        $response->assertSee('249999');
        $response->assertSee('This is a description for Laptop 1');
    }

    /** @test */
    public function test_stock_level_none()
    {
        
        $product = factory(Product::class)->create(['quantity' => 0]);

        $response = $this->get('/shop/'.$product->slug);

        $response->assertSee('Not in stock');
        
    }

    /** @test */
    public function test_stock_level_ten()
    {
        
        $product = factory(Product::class)->create(['quantity' => 10]);

        $response = $this->get('/shop/'.$product->slug);

        $response->assertSee('10+ in stock');
        
    }

    /** @test */
    public function test_relate_products()
    {
        $product1 = factory(Product::class)->create(['name' => 'Product 1']);
        $product2 = factory(Product::class)->create(['name' => 'Product 2']);

        $response = $this->get('/shop/'.$product1->slug);

        $response->assertSee('Product 2');
        $response->assertViewHas('mightAlsoLike');
    }
}
