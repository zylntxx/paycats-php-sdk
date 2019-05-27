<?php

declare(strict_types=1);

namespace Cmzz\Paycats\Requests;

abstract class Request
{
    protected $redirect = false;
    protected $data;
    protected $method;
    protected $path;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    function isRedirect(): bool
    {
        return $this->redirect;
    }

    function getMethod(): string
    {
        return $this->method ?? \Requests::POST;
    }

    function getApi(): string
    {
        return $this->path;
    }

    abstract function getData(): array ;
}