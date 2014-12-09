<?php

class ValidationExceptionTest extends TestCase
{

    public function testException()
    {
        try {
            throw new ValidationException(Validator::make(array(), array()));
        } catch (ValidationException $e) {
            $this->assertTrue($e->get() instanceof \Illuminate\Validation\Validator);
            $this->assertTrue(is_array($e->allMessages()));
        }
    }
}
