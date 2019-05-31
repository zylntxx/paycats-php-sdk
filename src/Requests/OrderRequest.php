<?php

declare(strict_types=1);

namespace Paycats\Sdk\Requests;

use Paycats\Sdk\Exceptions\InvalidArgumentException;

class OrderRequest extends Request
{
    function getData(): array
    {
        if (
        !(isset($this->data['order_no']) && $this->data['order_no'])
        ) {
            throw new InvalidArgumentException();
        }

        return parent::getData();
    }
}