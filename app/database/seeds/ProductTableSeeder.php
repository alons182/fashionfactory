<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ProductTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			$name = $faker->name;
			Product::create([
				'name' => $name,
				'slug' => Str::slug($name),
				'description' => '<p>'.  implode('</p><p>', $faker->paragraphs(5)) .'</p>', 
                'price' => $faker->randomElement([10000,15000,20000,30000]),
                'image' => null,
                'published' => 1
			]);
		}
	}

}

