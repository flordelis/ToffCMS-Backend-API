<?php

/**
 * Navigation repository.
 */
class NavigationRepository extends Repository
{
    /**
     * Constructor.
     *
     * @param Navigation $model Navigation model.
     */
    public function __construct(Navigation $model)
    {
        $this->model = $model;
    }

    /**
     * Find the first navigation level.
     *
     * @return [Navigation]
     */
    public function findFirstLevel()
    {
        return $this->getModel()
            ->where('parent_id', null)
            ->with('children')
            ->orderBy('order_id')
            ->get();
    }

    /**
     * Find navigation instances by language.
     *
     * @param string $language Language of the nav instances to be retrieved.
     *
     * @return [Navigation]
     */
    public function findByLanguage($language)
    {
        return $this->getModel()
            ->where('language', $language)
            ->where('parent_id', null)
            ->with('children')
            ->orderBy('order_id')
            ->get();
    }

    /**
     * Update the item order.
     *
     * @param array   $items     Items that will be updated.
     * @param integer $parent_id Parent ID.
     *
     * @throws InvalidArgumentException If ID of an item is not set.
     * @return boolean
     */
    public function updateOrder(array $items, $parent_id = 0)
    {
        $index = 0;

        foreach ($items as $row) {
            if (isset($row['id']) === false) {
                throw new InvalidArgumentException('ID must be set');
            }

            $this->getModel()
                ->where('id', '=', $row['id'])
                ->update(array('order_id' => ++$index, 'parent_id' => $parent_id));

            if (isset($row['children']) && $row['children']) {
                self::updateOrder($row['children'], $row['id']);
            }
        }

        return true;
    }
}
