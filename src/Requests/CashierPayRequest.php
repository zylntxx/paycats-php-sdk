<?php

declare(strict_types=1);

namespace Paycats\Sdk\Requests;

use Paycats\Sdk\Api;
use Paycats\Sdk\Exceptions\InvalidArgumentException;

class CashierPayRequest extends Request
{
    protected $path = Api::CASHIER_PAY;
    protected $redirect = true;
    protected $method = 'GET';

    function getData(): array
    {
        if (
            !(isset($this->data['total_fee']) && $this->data['total_fee'] > 1) ||
            !(isset($this->data['out_trade_no']) && $this->data['out_trade_no']) ||
            !(isset($this->data['openid']) && $this->data['openid']) ||
            !(isset($this->data['callback_url']) && $this->data['callback_url']) ||
            !(isset($this->data['body']) && $this->data['body'])
        ) {
            throw new InvalidArgumentException();
        }

        return parent::getData();
    }
}