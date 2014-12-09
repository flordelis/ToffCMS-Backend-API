<?php

/**
 * Eloquent model extension.
 */
class EloquentExtension extends Eloquent
{
    public static $rules = array(
        'default' => array(),
    );

    /**
     * Get the validation rules of a model.
     *
     * @param string $key Array key.
     *
     * @return array
     */
    public static function getRules($key = null)
    {
        $rules = array();

        if (isset(static::$rules['default'])) {
            $rules = static::$rules['default'];
        }

        // Marge in the specific rules
        if ($key !== null && isset(static::$rules[$key])) {
            $rules = array_merge($rules, static::$rules[$key]);
        }

        return $rules;
    }

    /**
     * Validate the model of fail.
     *
     * @param array  $input Users input.
     * @param string $type  Validation rule key.
     *
     * @throws ValidationException If validation fails.
     * @return boolean
     */
    public static function validateOrFail(array $input, $type = null)
    {
        $validator = Validator::make($input, static::getRules($type));

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return true;
    }
}
