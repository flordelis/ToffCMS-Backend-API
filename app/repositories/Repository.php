<?php

/**
 * Abstract repository class.
 */
abstract class Repository
{
    protected $model;

    /**
     * Find the model.
     *
     * @param integer $id Primary key of the row to be found.
     *
     * @return Objcet
     */
    public function find($id)
    {
        return $this->getModel()->find($id);
    }

    /**
     * Find or fail the model.
     *
     * @param integer $id Primary key of the row to be found.
     *
     * @return Objcet
     */
    public function findOrFail($id)
    {
        return $this->getModel()->findOrFail($id);
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
        $model = $this->findOrFail($id);
        $this->getModel()->validateOrFail($input, 'update');

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
        $this->getModel()->validateOrFail($input);

        $model = $this->getModel($input);
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
        return $this->getModel()->destroy($id);
    }

    /**
     * Get the model.
     *
     * @param array $params Params that will be passed to the model constructor.
     *
     * @return object
     */
    public function getModel(array $params = array())
    {
        return $this->model->fill($params);
    }
}
