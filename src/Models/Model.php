<?php


namespace Tanis\Models;


abstract class Model
{
    public $table;

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    public function getFields()
    {
    }

    public function getValues()
    {
    }
}