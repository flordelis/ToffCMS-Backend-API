<?php

/**
 * Site settings
 *
 * PHP version 5
 *
 * @category API
 * @package  ToffCMS
 * @author   Matiss Janis Aboltins <matiss@mja.lv>
 * @link     http://www.mja.lv/
 */
class SettingController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $settings = BackendSetting::get();
        return static::response($settings->toArray());
    }

    /**
     * Display the publicly available settings (frontend settings).
     * @return Response
     */
    public function frontend()
    {
        $settings = FrontendSetting::where('is_public', 'Y')
                            ->get();

        $return = array();

        foreach ($settings as $setting) {
            $return[$setting->key] = $setting->value;
        }

        return static::response($return);
    }
}
