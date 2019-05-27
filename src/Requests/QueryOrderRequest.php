<?php

declare(strict_types=1);

namespace Cmzz\Paycats\Requests;

use Cmzz\Paycats\Api;

class QueryOrderRequest extends OrderRequest
{
    protected $path = Api::QUERY_ORDER;

}