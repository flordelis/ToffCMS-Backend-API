<?php

/**
 * Used for calling migration command on server that doesn't have SSH.
 */
class DeveloperController extends BaseController
{
    /**
     * Index method.
     *
     * @return void
     */
    public function index()
    {
        Artisan::call('migrate', array('--force' => true));
    }
}
