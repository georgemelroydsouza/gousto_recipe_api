<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\Recipe;

class RecipeController extends Controller
{

	/**
	 * function to list all the recipes
	 * @return Illuminate\Support\Facades\Response
	 */
	public function index()
    {
		// list all the recipe in the database
        return Recipe::all();
    }
 
	public function import()
	{
		// clear the table in case data exists
		$csv_data = new Recipe();
		$csv_data::truncate();
		
		// import the records from the csv stored in public folder
		$lineLoop = 0;
		if (($handle = fopen ( public_path () . '/RECIPE_DATA.csv', 'r' )) !== FALSE) {
			while ( ($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) {
				if ($lineLoop > 0)
				{
					$csv_data = new Recipe ();
					$csv_data->id = $data [0];
					$csv_data->created_at = date('Y-m-d H:i:s', strtotime(strtr($data[1], '/', '-')));
					$csv_data->updated_at = date('Y-m-d H:i:s', strtotime(strtr($data[2], '/', '-')));
					$csv_data->box_type = $data [3];
					$csv_data->title = $data [4];
					$csv_data->slug = $data [5];
					$csv_data->short_title = $data [6];
					$csv_data->marketing = $data [7];
					$csv_data->calories_kcal = $data [8];
					$csv_data->protein_grams = $data [9];
					$csv_data->fat_grams = $data [10];
					$csv_data->carbs_grams = $data [11];
					$csv_data->bulletpoint1 = $data [12];
					$csv_data->bulletpoint2 = $data [13];
					$csv_data->bulletpoint3 = $data [14];
					$csv_data->recipe_diet_type_id = $data [15];
					$csv_data->season = $data [16];
					$csv_data->base = $data [17];
					$csv_data->protein_source = $data [18];
					$csv_data->preparation_time_minutes = $data [19];
					$csv_data->shelf_life_days = $data [20];
					$csv_data->equipment_needed = $data [21];
					$csv_data->origin_country = $data [22];
					$csv_data->recipe_cuisine = $data [23];
					$csv_data->in_your_box = $data [24];
					
					$csv_data->save ();
				}
				$lineLoop++;
			}
			fclose ( $handle );
		}
		return Recipe::all();
	}
	
	/**
	 * function to display details of the recipe for the ID provided
	 * @param int $id
	 * @return Illuminate\Support\Facades\Response
	 */
    public function show($id)
    {
		// find the recipe by the id 
		$recipeObject = Recipe::find($id);
		if (!$recipeObject) {
			return response()->json(['message' => 'Could not find the recipe'], 404);
		}
		return $recipeObject;
	}
	
	/**
	 * function to list all the recipes for the cuisine defined
	 * @param string $cuisine
	 * @return Illuminate\Support\Facades\Response
	 */
	public function findCuisines($cuisine)
	{
		// paginate via the recipe cuisine
		return Recipe::where('recipe_cuisine', 'like', $cuisine)
			->paginate(5);
		
	}
	
	/**
	 * function to list all unique cuisines
	 * @return Illuminate\Support\Facades\Response
	 */
	public function listCuisines()
	{
		// list unique recipe cuisine
		return Recipe::distinct()->get(['recipe_cuisine']);
		
	}

	/**
	 * function to add a new recipe
	 * @param Illuminate\Http\Request $request
	 * @return Illuminate\Support\Facades\Response
	 */
    public function store(Request $request)
    {
		$result = $this->validateForm($request);
		if ($result['success'] == false) {
			return response()->json([$result['message']], 422);
		}
		
		$recipeObject = new Recipe;
		foreach ($request->all() as $columnName => $value) {
			if ($columnName != 'id') {
				$recipeObject[$columnName] = (string)$value;
			}
		}
		$recipeObject->save();
		
        return $recipeObject;
    }

	/**
	 * function to update an existing recipe
	 * @param Illuminate\Http\Request $request
	 * @param integer $id
	 * @return Illuminate\Support\Facades\Response
	 */
    public function update(Request $request, $id)
    {
		// validation block
		$result = $this->validateForm($request);
		if ($result['success'] == false) {
			return response()->json([$result['message']], 422);
		}
	
		$recipeObject = Recipe::find($id);
		if (!$recipeObject) {
            return response()->json(['message' => 'Could not find the recipe'], 404);
		}
		
		// block to update the recipe
		$recipeItems = $request->all();
		$recipeObject->timestamps = false; // exclude updating the timestamps
		foreach ($request->all() as $columnName => $value) {
			if ($columnName != 'id') {
				$recipeObject[$columnName] = $value;
			}
		}
		
        $recipeObject->save();

        return $recipeObject;
    }

	/**
	 * function to validate the params sent to create / edit a recipe
	 * @param Illuminate\Http\Request $request
	 * @return array
	 */
	private function validateForm(Request $request) {
		
		$result['success'] = true;
		$result['message'] = array();
		
		foreach ($request->all() as $columnName => $value) {
			
			switch ($columnName) {
				case 'calories_kcal':
					if ((int)$value < 0) {
						$result['success'] = false;
						$result['message']['calories_kcal'] = 'Calories should be an integer';
					}
				break;
				case 'protein_grams':
					if ((int)$value < 0) {
						$result['success'] = false;
						$result['message']['protein_grams'] = 'Protien should be an integer' . $value;
					}
				break;
				case 'carbs_grams':
					if ((int)$value < 0) {	
						$result['success'] = false;
						$result['message']['carbs_grams'] = 'Carbs should be an integer';
					}
				break;
				case 'preparation_time_minutes':
					if ((int)$value < 0) {
						$result['success'] = false;
						$result['message']['preparation_time_minutes'] = 'Preparation time should be an integer';
					}
				break;	
			}
		}
		
		return $result;
		
	}
	
}
