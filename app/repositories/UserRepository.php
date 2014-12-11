<?php

/**
 * Page repository.
 */
class UserRepository extends Repository
{
    /**
     * Constructor.
     *
     * @param User $model User model.
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Find user by email.
     *
     * @param string $email Users email.
     *
     * @return User
     */
    public function findByEmail($email)
    {
        return $this->getModel()
            ->where('email', $email)
            ->take(1)
            ->firstOrFail();
    }
}
