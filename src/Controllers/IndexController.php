<?php


namespace Tanis\Controllers;


class IndexController
{
    public function get()
    {
        echo file_get_contents(__DIR__ . './../../public/views/index.html');
    }
}