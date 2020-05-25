<?php


namespace app\kernel;

use app\kernel\View;

class Response
{
    public function render(String $pageName, Array $pageParams)
    {
        new View($pageParams);

        require('../../public/pages/'.$pageName. '.php');
    }

    public function json(Array $data)
    {
        return json_encode($data);
    }
}