<?php

namespace app\controllers;

use app\models\User;

class ExampleController
{
    public static function index()
    {
        var_dump(
            json_decode(file_get_contents('php://input'), true)
        );
    }
}