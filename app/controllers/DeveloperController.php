<?php

class DeveloperController extends BaseController {

    public function index()
    {
        return Artisan::call('migrate');
    }

}
