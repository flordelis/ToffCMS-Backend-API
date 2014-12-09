<?php

use Symfony\Component\Security\Core\Exception\AuthenticationException;

/**
 * Manage login actions.
 */
class LoginController extends BaseController
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
     * Used for logging in the current user.
     *
     * Basically check the email/password and
     * returns the API key for further usage.
     *
     * @throws AuthenticationException If auth was not successful.
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
        if (Auth::attempt($userdata, false, false) === false) {
            throw new AuthenticationException();
        }

        // Get the userdata
        $user = $this->user->findByEmail($email);

        // Return the api key
        return static::response($user->toArray());
    }
}
