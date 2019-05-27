<?php

declare(strict_types=1);

namespace Cmzz\Paycats\Requests;

use Cmzz\Paycats\Api;

class F2FPayPayRequest extends NativePayRequest
{
    protected $path = Api::F2F_PAY;
}