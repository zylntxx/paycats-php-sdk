<?php

declare(strict_types=1);

namespace Paycats\Sdk\Requests;

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
        return $this->method ?? 'POST';
    }

    function getApi(): string
    {
        return $this->path;
    }

    function getData(): array
    {
        return $this->data;
    }
}