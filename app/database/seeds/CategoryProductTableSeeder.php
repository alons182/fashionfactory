<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CategoryProductTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		$productIds = Product::lists('id');
		$categoryIds = Category::withoutRoot()->withDepth()->having('depth', '>', 1)->lists('id');
		foreach(range(1, 20) as $index)
		{
			
			DB::table('category_product')->insert([
					'category_id' => $faker->randomElement($categoryIds),
					'product_id' => $faker->randomElement($productIds)
				]);
			
		}
	}

}