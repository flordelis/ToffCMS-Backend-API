<?php

class SettingController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$settings = BackendSetting::get();
		return static::response('settings', $settings->toArray());
	}

	public function frontend()
	{
		$settings = FrontendSetting::where('is_public', 'Y')
							->get();

		$return = array();

		foreach ($settings as $setting)
		{
			$return[$setting->key] = $setting->value;
		}

		return static::response('settings', $return);
	}

}
