<?php

declare(strict_types=1);

namespace Cmzz\Paycats\Requests;

use Cmzz\Paycats\Api;

class RefundOrderRequest extends OrderRequest
{
    protected $path = Api::REFUND_ORDER;

}