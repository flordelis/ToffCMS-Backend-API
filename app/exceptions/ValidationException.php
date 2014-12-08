<?php

class ValidationException extends Exception
{
    /**
     * Errors object.
     *
     * @var Laravel\Messages
     */
    private $errors;

    /**
     * Create a new validate exception instance.
     *
     * @param  Laravel\Validator|Laravel\Messages  $container
     * @return void
     */
    public function __construct($container)
    {
        $this->errors = ($container instanceof Validator) ? $container->errors : $container;

        parent::__construct('Failed validating resource.');
    }

    /**
     * Gets the errors object.
     *
     * @return Laravel\Messages
     */
    public function get()
    {
        return $this->errors;
    }

    /**
     * Get all of the validation messages
     * @return [string]
     */
    public function allMessages()
    {
        return $this->get()->messages()->all();
    }
}
