<?php

declare(strict_types=1);

namespace Paycats\Sdk\Requests;

use Paycats\Sdk\Api;
use Paycats\Sdk\Exceptions\InvalidArgumentException;

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