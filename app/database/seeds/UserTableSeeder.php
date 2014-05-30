<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder {

	public function run()
	{
			DB::table('users')->delete();
        
       		User::create([
				'username' => 'admin',
				'email' => 'admin@admin.com', 
                'password' => "123",
                'user_type' => 'admin'
			]);

			User::create([
				'username' => 'user',
				'email' => 'user@user.com', 
                'password' => "123",
                'user_type' => 'basic'
			]);
	}

}

			