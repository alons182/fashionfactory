<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use Kalnoy\Nestedset\NestedSet;

class CategoryTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		 // The root node is required
        NestedSet::createRoot('categories', array(
            'name' => 'Root',
            'slug' => 'root',
            'description' => '',
            'image'=>null,
            'published' => 1
        ));

		foreach(range(1, 3) as $index)
		{
			$name = $faker->word;

			$node = new Category([

				'name' => $name,
				'slug' => Str::slug($name),
				'description' => '<p>'.  implode('</p><p>', $faker->paragraphs(2)) .'</p>', 
                'image' => null,
                'published' => 1,
                'featured' => 1


			
			]);
			$target = Category::root();

			$node->appendTo($target)->save();
			
		}
		
		$categoriesRootIds = Category::withDepth()->having('depth', '>=', 1)->lists('id');
		
		foreach(range(1, 10) as $index)
		{
			$name = $faker->word;

			$node = new Category([

				'name' => $name,
				'slug' => Str::slug($name),
				'description' => '<p>'.  implode('</p><p>', $faker->paragraphs(2)) .'</p>', 
                'image' => null,
                'view_type' => $faker->randomElement(['default','portrait','image-feature','landscape image-feature']),
                'published' => 1


			
			]);
			$target = Category::find($faker->randomElement($categoriesRootIds));

			$node->appendTo($target)->save();
			
		}
	}

}