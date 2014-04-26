<?php

class LoginController extends \BaseController {

	/**
	 * Used for logging in the current user
	 * Basically check the email/password and
	 * returns the API key for further usage.
	 *
	 * @return Response
	 */
	public function getApiKey()
	{
		$email = Input::get('email');
		$password = Input::get('password');

		$userdata = array(
			'email' => $email,
			'password' => $password
		);

		// Is this a successful authorization?
		if (Auth::attempt($userdata, false, false) === false)
		{
			return static::response('message', 'Wrong email/password', true);
		}

		// Get the userdata
		$user = User::where('email', $email)
					->take(1)
					->get()
					->toArray();

		// Return the api key
		return static::response('user', $user[0]);
	}

}
