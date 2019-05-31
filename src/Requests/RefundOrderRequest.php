<?php

declare(strict_types=1);

namespace Paycats\Sdk\Requests;

use Paycats\Sdk\Api;

class RefundOrderRequest extends OrderRequest
{
    protected $path = Api::REFUND_ORDER;

}