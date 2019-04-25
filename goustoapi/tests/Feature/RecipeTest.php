<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RecipeTest extends TestCase
{
    /**
     * Testing of list recipe functionality
     *
     * @return void
     */
    public function testRecipe()
    {
        $this->json('GET', 'api/recipes')
            ->assertStatus(200);

	}
	
	/**
	 * function to test the list of recipe by id functionality
	 * 
	 * @return void
	 */
	public function testFindRecipeById()
	{
		$this->json('GET', 'api/recipes/import')
			->assertStatus(200);
		
		$this->json('GET', 'api/recipes/2')
			->assertStatus(200);
	}
	
	/**
	 * function to test the list of recipe by id functionality
	 * 
	 * @return void
	 */
	public function testFindRecipeByInvalidId()
	{
		$this->json('GET', 'api/recipes/import')
			->assertStatus(200);
		
		$this->json('GET', 'api/recipes/300')
			->assertStatus(404)
			->assertJson([
				'message'	=>	'Could not find the recipe'
			]);
	}
	
	/**
	 * function to test the list of recipe by cuisine functionality
	 * 
	 * @return void
	 */
	public function testFindRecipeByCuisine()
	{
		$this->json('GET', 'api/recipes/import')
			->assertStatus(200);
		
		$this->json('GET', 'api/recipes/cuisines/british')
			->assertStatus(200);
	}
	
	/**
	 * function to test the add new functionality
	 * 
	 * @return void
	 */
	public function testAddNewRecipe()
	{
		
		$recipe = [
            "box_type" => "vegetarian",
			"title" => "Sweets Chilli and Lime Pork on a Crunchy Fresh Noodle Salad",
			"slug" => "sweet-chilli-and-lime-pork-on-a-crunchy-fresh-noodle-salad",
			"short_title" => "",
			"marketing" => "Here we've used onglet steak which is an extra flavoursome cut of beef that should never be cooked past medium rare. So if you're a fan of well done steak, this one may not be for you. However, if you love rare steak and fancy trying a new cut, please be",
			"calories_kcal" => 401,
			"protein_grams" => 12,
			"fat_grams" => 35,
			"bulletpoint1" => "",
			"bulletpoint2" => "",
			"bulletpoint3" => "",
			"recipe_diet_type_id" => "meat",
			"season" => "all",
			"base" => "noodles",
			"protein_source" => "pork",
			"preparation_time_minutes" => 35,
			"shelf_life_days" => "4",
			"equipment_needed" => "Appetite",
			"origin_country" => "Great Britain",
			"recipe_cuisine" => "asian",
			"in_your_box" => "",
			"gousto_reference" => "0"
        ];
		
		$this->json('POST', 'api/recipes', $recipe)
			->assertStatus(200);
			
	
	}
	
}
