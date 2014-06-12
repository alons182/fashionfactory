<?php

class DatabaseSeeder extends Seeder {

	private $tables = [
		'users',
		'categories',
		'products',
		'category_product'
	];

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->cleanDatabase();
		
		Eloquent::unguard();

		$this->call('UserTableSeeder');
		$this->call('CategoryTableSeeder');
		$this->call('ProductTableSeeder');
		$this->call('CategoryProductTableSeeder');
	}

	private function cleanDatabase()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		
		foreach ($this->tables as $tablename) {
			DB::table($tablename)->truncate();
		}

		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}

}
