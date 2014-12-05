<?php

class Page extends Eloquent {

	protected $table = 'pages';
	protected $hidden = array('updated_at', 'author_id');

	/**
	 * Validate the input
	 * @param  array $input
	 * @param  string $type
	 * @return Validator
	 */
	public static function validate($input, $type = null)
	{
		$allRules = array(
			'default' => array(
				'title'        => array('required', 'max:100'),
				'slug'         => array('required', 'max:100', 'unique:pages,slug,null,id,language,'. Input::get('language')),
				'status'       => array('in:draft,live'),
				'language'     => array('in:lv,en,ru'),
				'body'         => array('required')
			),
			'update' => array(
				'slug'         => array('required', 'max:100'),
			)
		);

		// Get the default rules
		$rules = $allRules['default'];

		// Marge in the specific rules
		if ($type !== null && isset($allRules[$type]))
		{
			$rules = array_merge($rules, $allRules[$type]);
		}

		return Validator::make($input, $rules);
	}

	public function author()
	{
		return $this->hasOne('User', 'id', 'author_id')
					->select('id', 'email');
	}

	public function getAuthorIdAttribute($value)
	{
		return (int) $value;
	}

	public function getIdAttribute($value)
	{
		return (int) $value;
	}

}
