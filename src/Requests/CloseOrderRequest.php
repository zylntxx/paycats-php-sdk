<?php

declare(strict_types=1);

namespace Paycats\Sdk\Requests;

use Paycats\Sdk\Api;

class CloseOrderRequest extends OrderRequest
{
    protected $path = Api::CLOSE_ORDER;

}