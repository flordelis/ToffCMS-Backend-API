<?php

class NavigationRepository extends Repository
{
    protected static $model = 'Navigation';

    /**
     * Find the first navigation level
     * @return [Navigation]
     */
    public static function findFirstLevel()
    {
        return Navigation::where('parent_id', null)
            ->with('children')
            ->orderBy('order_id')
            ->get();
    }

    /**
     * Find navigation instances by language
     * @param  string $language
     * @return [Navigation]
     */
    public static function findByLanguage($language)
    {
        return Navigation::where('language', $language)
            ->where('parent_id', null)
            ->with('children')
            ->orderBy('order_id')
            ->get();
    }

    /**
     * Update the item order
     * @param  array $items
     * @return boolean
     */
    public static function updateOrder(array $items, $parent_id = 0)
    {
        $index = 0;

        foreach ($items as $row) {
            if (isset($row['id']) === false) {
                throw new InvalidArgumentException('ID must be set');
            }

            Navigation::where('id', '=', $row['id'])
                ->update(array('order_id' => ++$index, 'parent_id' => $parent_id));

            if (isset($row['children']) && $row['children']) {
                self::updateOrder($row['children'], $row['id']);
            }
        }

        return true;
    }
}
