<?php

abstract class Setting extends Eloquent {

    protected $table = 'settings';

    public function getIdAttribute($value)
    {
        return (int) $value;
    }

    public function getValueAttribute($value)
    {
        return empty($value) ? $this->attributes['default'] : $value;
    }

    public function getAvailableValuesAttribute($value)
    {
        if (strpos($value, '|') === false) {
            return $value;
        }

        return explode('|', $value);
    }

}
