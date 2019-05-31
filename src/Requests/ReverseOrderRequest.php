<?php

declare(strict_types=1);

namespace Paycats\Sdk\Requests;

use Paycats\Sdk\Api;

class ReverseOrderRequest extends OrderRequest
{
    protected $path = Api::REVERSE_ORDER;

}