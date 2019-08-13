<?php


namespace Tests\Feature;


use App\Brand;
use App\Category;
use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

final class SaveProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_product_can_be_saved()
    {
        $category = factory(Category::class)->make([
            'name' => 'Water'
        ]);
        $category->save();
        $brand = new Brand();
        $brand->brandname = 'Ola';
        $brand->save();

        $product = [
            'brand' => 1,
            'categories' => [
                [
                    'id' => 1,
                    'name' => 'Water'
                ]
            ],
            'kosher' => true,
            'koshertype' => 'Parve',
            'eancode' => '98765432',
            'productname' => 'Water Ijsje water smaak',
            ''
        ];
        $response = $this->postJson('/api/products', $product);
        $response->assertStatus(JsonResponse::HTTP_CREATED);
        $this->assertEquals(1, Product::count());
        $savedProduct = Product::first();
        $this->assertEquals($savedProduct->categories()->count(), 1, 'There should be exactly one category');
    }

    /** @test */
    public function ean_code_should_not_be_required()
    {

        $product = factory(Product::class)->make([
            'eancode' => null
        ]);

        $response = $this->postJson('/api/products', $product->toArray());
        $response->assertStatus(JsonResponse::HTTP_CREATED);
        $this->assertEquals(1, Product::count());

    }

    /** @test */
    public function product_name_is_required_to_save_products()
    {
        $product = factory(Product::class)->make(([
            'productname' => null
        ]));
        $response = $this->postJson('/api/products', $product->toArray());

        $response->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        $this->assertArrayHasKey('errors', $response->decodeResponseJson());
        $this->assertArrayHasKey('productname', $response->decodeResponseJson()['errors']);

    }

}
