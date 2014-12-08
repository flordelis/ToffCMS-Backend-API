<?php

abstract class Repository
{
    protected static $model;

    /**
     * Find or fail the model.
     * @param  integer $id
     * @return Objcet
     */
    public static function findOrFail($id)
    {
        return static::getModel()->findOrFail($id);
    }

    /**
     * Update a page.
     * @param  integer $id
     * @param  array $input
     * @return Object
     */
    public function update($id, array $input)
    {
        $page = static::findOrFail($id);
        static::getModel()->validateOrFail($input, 'update');

        $page->save($input);
        return $page;
    }

    /**
     * Create a new page.
     * @param  array $input
     * @return Object
     */
    public function create($input)
    {
        static::getModel()->validateOrFail($input);

        $page = static::getModel($input);
        $page->save();

        return $page;
    }

    /**
     * Delete the page
     * @param  integer $id
     * @return boolean
     */
    public function delete($id)
    {
        return static::getModel()->destroy($id);
    }

    /**
     * Get the model
     * @param  mixed $params
     * @return object
     */
    public static function getModel(array $params = array())
    {
        $model = static::$model;
        return new $model($params);
    }
}
