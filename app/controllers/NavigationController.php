<?php

/**
 * Navigation management
 *
 * PHP version 5
 *
 * @category API
 * @package  ToffCMS
 * @author   Matiss Janis Aboltins <matiss@mja.lv>
 * @link     http://www.mja.lv/
 */
class NavigationController extends BaseController
{
    protected $navigation;

    /**
     * Constructor
     * @param  NavigationRepository $navigation Navigation repository
     */
    public function __construct(NavigationRepository $navigation)
    {
        $this->navigation = $navigation;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $nav = $this->navigation->findFirstLevel();
        return static::response($nav->toArray());
    }


    /**
     * Save the order
     * @return Response
     */
    public function saveOrder()
    {
        $this->navigation->updateOrder(Input::get('data'));
        return static::response('Successfully saved the order');
    }


    /**
     * Store a newly created resource in storage.
     * @return Response
     */
    public function store()
    {
        $nav = $this->navigation->create(Input::all());
        return static::response($nav->toArray());
    }


    /**
     * Display the specified resource.
     * @param  string $language In which language should we return the nav?
     * @return Response
     */
    public function show($language)
    {
        $nav = $this->navigation->findByLanguage($language);
        return static::response($nav->toArray());
    }


    /**
     * Update the specified resource in storage.
     * @param  int $id Primary key of a nav instance
     * @return Response
     */
    public function update($id)
    {
        $nav = $this->navigation->update($id, Input::all());
        return static::response($nav->toArray());
    }


    /**
     * Remove the specified resource from storage.
     * @param  int $id Primary key of a navigation instance
     * @return Response
     */
    public function destroy($id)
    {
        $this->navigation->delete($id);
        return static::response(true);
    }
}
