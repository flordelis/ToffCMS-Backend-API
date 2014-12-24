<?php

/**
 * Setting abstract class.
 */
abstract class Setting extends Eloquent
{
    protected $table = 'settings';
    protected $fillable = array('name', 'description', 'key', 'default', 'value', 'available_values', 'is_public');

    /**
     * Get ID attr.
     *
     * @param string $value Value from DB.
     *
     * @return integer
     */
    public function getIdAttribute($value)
    {
        return (int) $value;
    }

    /**
     * Get value attr.
     *
     * @param string $value Value from DB.
     *
     * @return string
     */
    public function getValueAttribute($value)
    {
        return empty($value) ? $this->attributes['default'] : $value;
    }

    /**
     * Get available value attr.
     *
     * @param string $value Value from DB.
     *
     * @return array
     */
    public function getAvailableValuesAttribute($value)
    {
        if (strpos($value, '|') === false) {
            return $value;
        }

        return explode('|', $value);
    }
}
