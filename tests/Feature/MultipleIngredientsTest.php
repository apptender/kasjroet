<?php

namespace Tests\Feature;

use App\Ingredient;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MultipleIngredientsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function a_user_can_save_multiple_ingredients()
    {
        $ingredients = [
            'Water',
            'Aardbeienpuree',
            'Suiker',
            'Glucose'
        ];

        $response = $this->postJson('/api/ingredients-collection', $ingredients);
        $this->assertDatabaseHas('ingredients', ['name'=> 'Water']);
        $this->assertTrue(is_array($response->json()));
        $response->assertStatus(JsonResponse::HTTP_OK);
        $this->assertTrue(array_key_exists('saved', $response->json()));
    }

    /** @test */
    public function when_a_product_already_exists_it_should_be_added_to_the_list()
    {
        (new Ingredient([
            'name' => 'Water'
        ]))->save();

        $ingredients = [
            'Water',
            'Aardbeienpuree',
            'Suiker',
            'Glucose'
        ];
        $response = $this->postJson('/api/ingredients-collection', $ingredients);
        $response->assertStatus(200);
        $this->assertDatabaseHas('ingredients', ['name'=> 'Water']);
        $this->assertTrue(array_key_exists('saved', $response->json()));
        $this->assertEquals('Water', $response->json()['saved'][0]['name']);
        $this->assertEquals('Aardbeienpuree', $response->json()['saved'][1]['name']);
    }
}
