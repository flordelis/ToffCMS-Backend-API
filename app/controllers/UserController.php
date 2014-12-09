<?php

/**
 * User management.
 */
class UserController extends BaseController
{
    protected $user;

    /**
     * Constructor.
     *
     * @param UserRepository $user User repository.
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * Display the specified resource.
     *
     * @param integer $id Primary key of the user to be retrieved.
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->user->findOrFail($id);
        return static::response($user->toArray());
    }
}
