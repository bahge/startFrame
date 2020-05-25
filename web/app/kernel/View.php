<?php


namespace app\kernel;


class View
{
    public function __construct($data)
    {
        $GLOBALS['params'] = $data;
    }

    public static function getParams()
    {
        return $GLOBALS['params'];
    }

    public function getParam($name)
    {
        return $GLOBALS['params'][$name];
    }
}