<?php

declare(strict_types=1);

namespace Cmzz\Paycats\Requests;

use Cmzz\Paycats\Api;
use Cmzz\Paycats\Exceptions\InvalidArgumentException;

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