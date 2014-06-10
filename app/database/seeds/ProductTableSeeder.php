<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ProductTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			$name = $faker->word;
			Product::create([
				'name' => $name,
				'slug' => Str::slug($name),
				'description' => '<p>'.  implode('</p><p>', $faker->paragraphs(2)) .'</p>', 
                'price' => $faker->randomElement([10000,15000,20000,30000]),
                'promo_price' => $faker->randomElement([0,8000,5000,3000]),
                'sizes' => $faker->randomElements(['','S','M','L','32Wx21H','40','56']),
                'colors' => $faker->randomElements(['','000','FFF','e3e3e3']),
                'relateds' => [],
                'image' => null,
                'published' => 1
			]);
		}
	}

}

