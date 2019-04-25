<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipeRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe_ratings', function (Blueprint $table) {
            $table->increments('id');
			$table->timestamps();
			$table->integer('recipe_id')->unsigned();
			$table->string('email');
			$table->integer('ratings')->unsigned()->default(1);
			$table->text('comments')->default('');
		});
		Schema::table('recipe_ratings', function (Blueprint $table) {
			$table->foreign('recipe_id')->references('recipe_id')->on('recipes.id');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipe_ratings');
    }
}
