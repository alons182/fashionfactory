<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Kalnoy\Nestedset\NestedSet;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('slug');
			$table->text('description')->nullable();
			$table->string('image')->nullable();
			$table->enum('view_type',["default","portrait","image-feature", "landscape image-feature"]);
			//$table->integer('parent_id');
			$table->boolean('published')->default(1);
			$table->boolean('featured')->default(0);
			$table->timestamps();

			# nested
 			NestedSet::columns($table);


		});

		 // The root node is required
        NestedSet::createRoot('categories', array(
            'name' => 'Root',
            'slug' => 'root',
            'description' => '',
            'image'=>null,
            'published' => 1
        ));
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categories');
	}

}
