<?php

class UserRepository extends Repository {

	protected static $model = 'User';

	public function findByEmail($email)
	{
		return User::where('email', $email)
			->take(1)
			->firstOrFail();
	}
}
