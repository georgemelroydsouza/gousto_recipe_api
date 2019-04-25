<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
			$table->string('box_type')->default('vegetarian');
			$table->string('title');
			$table->string('slug')->default('');
			$table->string('short_title')->default('');
			$table->string('marketing')->default('');
			$table->integer('calories_kcal')->default(0);
			$table->integer('protein_grams')->default(0);
			$table->integer('fat_grams')->default(0);
			$table->integer('carbs_grams')->default(0);
			$table->string('bulletpoint1')->default('');
			$table->string('bulletpoint2')->default('');
			$table->string('bulletpoint3')->default('');
			$table->string('recipe_diet_type_id')->default('');
			$table->string('season')->default('');
			$table->string('base')->default('');
			$table->string('protein_source')->default('');
			$table->integer('preparation_time_minutes')->default('');
			$table->string('shelf_life_days')->default(0);
			$table->string('equipment_needed')->default('');
			$table->string('origin_country')->default('Great Britain');
			$table->string('recipe_cuisine')->default('');
			$table->text('in_your_box')->default('');
			$table->integer('gousto_reference')->default(0);			
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes');
    }
}
