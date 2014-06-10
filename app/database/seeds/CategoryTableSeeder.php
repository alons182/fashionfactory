<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CategoryTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 6) as $index)
		{
			$name = $faker->word;

			Category::create([

				'name' => $name,
				'slug' => Str::slug($name),
				'description' => '<p>'.  implode('</p><p>', $faker->paragraphs(2)) .'</p>', 
                'image' => null,
                'parent_id' => $faker->randomElement([1,2]),
                'published' => 1


			
			]);
		}
	}

}