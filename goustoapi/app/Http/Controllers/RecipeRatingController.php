<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

use App\Recipe;
use App\RecipeRatings;

class RecipeRatingController extends Controller
{
	/**
	 * function to list the ratings for a recipe id
	 * @param int $recipeid
	 * @return \Illuminate\Http\Response
	 */
    public function show($recipeid)
    {
		// list all the ratings for the current recipe id
		$recipeObject = Recipe::find($recipeid);
		if (!$recipeObject) {
            return response()->json(['message' => 'Recipe does not exists'], 404);
		}
		
		return RecipeRatings::where('recipe_id', '=', $recipeid)
			->get();
	}
	
	/**
	 * function to save the ratings for a recipe id
	 * @param \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
    public function store(Request $request)
    {
		$recipeObject = Recipe::find($request->get('recipe_id'));
		if (!$recipeObject) {
            return response()->json(['message' => 'Recipe does not exists'], 404);
		}
		
		$input = $request->all();
        $validator = $this->validator_create($input);
        if ($validator->fails()) {
            return Response::json(array(   // Better if use this with errors validation
                'message'   =>  'Could not update the recipe.',
                'errors'   =>  $validator->errors(),
            ), 400);
        }
		
		// insert into the recipe table
		$recipeRatingObject = new RecipeRatings;
		foreach ($request->all() as $columnName => $value) {
			if ($columnName != 'id') {
				$recipeRatingObject[$columnName] = (string)$value;
			}
		}
		$recipeRatingObject->save();
		
        return RecipeRatings::where('recipe_id', '=', $request->get('recipe_id'))
			->get();
    }
	
	/**
	 * function to validate the create params
	 * @param array $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	private function validator_create($data){
        return Validator::make($data, [
            'recipe_id' => 'required|exists:recipes,id',
            'ratings' => 'required|numeric|min:1|max:5',
            'email' => 'required|string|email|max:255'
        ]);
    }
	
}
