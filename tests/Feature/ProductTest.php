<?php

use Tests\TestCase;
use App\Models\User;
use App\Models\CatalogProduct;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_product()
    {

        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'name' => 'test product',
            'description' => 'test description',
            'height' => 10.0,
            'length' => 20.0,
            'width' => 15.0,
        ];

        $response = $this->postJson('/api/products', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['name' => 'test product']);
    }

    public function test_can_update_product()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $product = CatalogProduct::factory()->create();

        $data = [
            'name' => 'updated product',
        ];

        $response = $this->putJson("/api/products/{$product->id}", $data);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'updated product']);
    }

    public function test_can_delete_product()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = CatalogProduct::factory()->create();

        $response = $this->deleteJson("/api/products/{$product->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('catalog_products', ['id' => $product->id]);
    }
}
