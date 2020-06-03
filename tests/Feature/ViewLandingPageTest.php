<?php

namespace Tests\Feature;

use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewLandingPageTest extends TestCase
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
    public function test_landing_page_loads_correctly()
    {
    // Arrange    

    // Act
        $response = $this->get('/');    // Visit HOME page.

    // Assert
        $response->assertStatus(200);       // 200 successful request.
        $response->assertSee('Laravel Ecommerce');  // If there is text in the page which is tested.;
        $response->assertSee('Includes multiple products'); 
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
}
