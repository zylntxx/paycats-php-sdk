<?php

declare(strict_types=1);

namespace Paycats\Sdk\Requests;

use Paycats\Sdk\Api;

class F2FPayPayRequest extends NativePayRequest
{
    protected $path = Api::F2F_PAY;
}