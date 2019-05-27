<?php

declare(strict_types=1);

namespace Cmzz\Paycats\Requests;

use Cmzz\Paycats\Api;
use Cmzz\Paycats\Exceptions\InvalidArgumentException;

class NativePayRequest extends Request
{
    protected $path = Api::NATIVE_PAY;

    function getData(): array
    {
        if (
            !(isset($this->data['total_fee']) && $this->data['total_fee'] > 1) ||
            !(isset($this->data['out_trade_no']) && $this->data['out_trade_no']) ||
            !(isset($this->data['body']) && $this->data['body'])
        ) {
            throw new InvalidArgumentException();
        }

        return parent::getData();
    }
}