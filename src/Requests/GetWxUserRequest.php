<?php

declare(strict_types=1);

namespace Paycats\Sdk\Requests;

use Paycats\Sdk\Api;
use Paycats\Sdk\Exceptions\InvalidArgumentException;

class GetWxUserRequest extends Request
{
    protected $path = Api::WX_USER;
    protected $redirect = true;
    protected $method = 'GET';

    function getData(): array
    {
        if (
            !(isset($this->data['openid']) && $this->data['openid'])
        ) {
            throw new InvalidArgumentException();
        }

        return parent::getData();
    }
}