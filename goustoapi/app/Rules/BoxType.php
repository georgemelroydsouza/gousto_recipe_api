<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

//use App\Recipe;

class BoxType implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
		//$boxTypesArray = Recipe::distinct()->get(['box_type']);
		
	//	$exists = false;
	//	foreach ($boxTypesArray as $boxTypeValue) {
	//		if (strtolower($boxTypeValue) == strtolower($value)) {
	//			$exists = true;
	//		}
	//	}
		
		return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Box type can either be vegetarian/gourmet';
    }
}
