<?php

/**
 * Abstract repository class.
 */
abstract class Repository
{
    protected static $model;

    /**
     * Find or fail the model.
     *
     * @param integer $id Primary key of the row to be found.
     *
     * @return Objcet
     */
    public static function findOrFail($id)
    {
        return static::getModel()->findOrFail($id);
    }

    /**
     * Update a resource.
     *
     * @param integer $id    Primary key of the row to be updated.
     * @param array   $input Input.
     *
     * @return Class
     */
    public function update($id, array $input)
    {
        $model = static::findOrFail($id);
        static::getModel()->validateOrFail($input, 'update');

        $model->save($input);
        return $model;
    }

    /**
     * Create a new model.
     *
     * @param array $input Input with which the row will be created.
     *
     * @return Class
     */
    public function create(array $input)
    {
        static::getModel()->validateOrFail($input);

        $model = static::getModel($input);
        $model->save();

        return $model;
    }

    /**
     * Delete the page.
     *
     * @param integer $id Primary key.
     *
     * @return boolean
     */
    public function delete($id)
    {
        return static::getModel()->destroy($id);
    }

    /**
     * Get the model.
     *
     * @param array $params Params that will be passed to the model constructor.
     *
     * @return object
     */
    public static function getModel(array $params = array())
    {
        $model = static::$model;
        return new $model($params);
    }
}
