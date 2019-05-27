<?php

declare(strict_types=1);

namespace Cmzz\Paycats\Requests;

use Cmzz\Paycats\Api;
use Cmzz\Paycats\Exceptions\InvalidArgumentException;

class GetWxOpenidRequest extends Request
{
    protected $path = Api::WX_OPENID;
    protected $redirect = true;
    protected $method = 'GET';

    function getData(): array
    {
        if (
            !(isset($this->data['callback_url']) && $this->data['callback_url'])
        ) {
            throw new InvalidArgumentException();
        }

        return parent::getData();
    }
}