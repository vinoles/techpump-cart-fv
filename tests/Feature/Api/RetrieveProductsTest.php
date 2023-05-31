<?php

namespace Tests\Feature\Api;

use App\Models\Product;

class RetrieveProductsTest extends TestCase
{
    /**
     * A guest user can retrieve the list of products.
     *
     * @test
     * @return void
     */
    public function can_retrieve_products(): void
    {
        Product::factory()->count(random_int(10, 20))->create();

        $response = $this->sendRequest();

        $response->assertSuccessful();

        $this->assertEquals(10, $response->json('per_page'));
    }
}
