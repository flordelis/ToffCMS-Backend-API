<?php

class EloquentExtension extends Eloquent {

	public static $rules = array(
		'default' => array(),
	);

	public static function getRules($key = null)
	{
		$rules = array();

		if (isset(static::$rules['default']) ) {
			$rules = static::$rules['default'];
		}

		// Marge in the specific rules
		if ($key !== null && isset(static::$rules[$key]))
		{
			$rules = array_merge($rules, static::$rules[$key]);
		}

		return $rules;
	}

	public static function validateOrFail($input, $type = null)
	{
		$validator = Validator::make($input, static::getRules($type));

		if ($validator->fails()) {
			throw new ValidationException($validator);
		}

		return true;
	}
}
