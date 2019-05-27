<?php

declare(strict_types=1);

namespace Cmzz\Paycats\Requests;

use Cmzz\Paycats\Api;

class CloseOrderRequest extends OrderRequest
{
    protected $path = Api::CLOSE_ORDER;

}