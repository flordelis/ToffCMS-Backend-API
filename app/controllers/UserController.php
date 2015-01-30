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

    /**
     * Register a new user
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();

        $input['confirmation_code'] = str_random(30);

        $user = $this->user->create($input);

        Mail::send('emails.auth.verify', $input, function($message) {
            $message->to(Input::get('email'))
                ->subject('Verify your email address');
        });

        return static::response($user->toArray());
    }
}
