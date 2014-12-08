<?php

/**
 * Developer controller used for calling migration
 * command on server that doesn't have SSH.
 *
 * PHP version 5
 *
 * @category API
 * @package  ToffCMS
 * @author   Matiss Janis Aboltins <matiss@mja.lv>
 * @link     http://www.mja.lv/
 */
class DeveloperController extends BaseController
{
    /**
     * Index method
     * @return void
     */
    public function index()
    {
        Artisan::call('migrate');
    }
}
