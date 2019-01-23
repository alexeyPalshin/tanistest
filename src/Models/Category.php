<?php


namespace Tanis\Models;


class Category extends Model
{
    /**
     * @var string
     */
    public $table = 'categories';

    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    public function __construct(array $fields)
    {
        $this->id = $fields['id'];
        $this->name = $fields['name'];
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return 'id, name';
    }

    public function getValues()
    {
        return '"' . $this->id . '", "' . $this->name . '"';
    }
}