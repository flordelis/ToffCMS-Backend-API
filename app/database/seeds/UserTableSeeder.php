<?php

class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->delete();

		User::create(array(
			'email' => 'mja@mja.lv',
			'password' => Hash::make('password'),
			'api_key' => Hash::make('key#1')
		));

		User::create(array(
			'email' => 'seconduser@example.org',
			'password' => Hash::make('second_password'),
			'api_key' => Hash::make('key#2')
		));
	}

}
