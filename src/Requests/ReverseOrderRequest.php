<?php

declare(strict_types=1);

namespace Cmzz\Paycats\Requests;

use Cmzz\Paycats\Api;

class ReverseOrderRequest extends OrderRequest
{
    protected $path = Api::REVERSE_ORDER;

}