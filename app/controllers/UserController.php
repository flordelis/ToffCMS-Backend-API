<?php

class UserController extends BaseController {

	protected $user;

	/**
	 * Constructor
	 * @param UserRepository $user
	 */
	public function __construct(UserRepository $user)
	{
		$this->user = $user;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = $this->user->findOrFail($id);
		return static::response($user->toArray());
	}

}
