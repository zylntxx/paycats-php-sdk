<?php

declare(strict_types=1);

namespace Paycats\Sdk\Requests;

use Paycats\Sdk\Api;

class QueryOrderRequest extends OrderRequest
{
    protected $path = Api::QUERY_ORDER;

}