<?php

/**
 * Page repository.
 */
class UserRepository extends Repository
{
    protected static $model = 'User';

    /**
     * Find user by email.
     *
     * @param string $email Users email.
     *
     * @return User
     */
    public function findByEmail($email)
    {
        return User::where('email', $email)
            ->take(1)
            ->firstOrFail();
    }
}
