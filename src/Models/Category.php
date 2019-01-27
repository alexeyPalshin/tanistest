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

    public function __construct()
    {
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
        return '"' . $this->getId() . '", "' . $this->getName() . '"';
    }

    /**
     * @param string $id
     */
    public function setId(string $id = '')
    {
        if (empty($id)) {
            $id = substr(md5($this->getName()), -24);
        }
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}