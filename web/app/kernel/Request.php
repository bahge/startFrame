<?php


namespace app\kernel;


class Request
{
    public $params = null;
    public $body = null;

    public function __construct($params, $body)
    {
        $this->params = $params;
        $this->body = $body;
    }

    public function getParam(string $paramName): string
    {
        return $this->params[$paramName];
    }

    public function getBody()
    {
        return $this->body;
    }

    public function json()
    {
        return json_decode(
            file_get_contents('php://input'), true
        );
    }
}