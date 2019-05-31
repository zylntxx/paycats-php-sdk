<?php

declare(strict_types=1);


namespace Paycats\Sdk;


class NotifyType
{
    const ORDER_SUCCEEDED = 'order.succeeded';
    const ORDER_CLOSED = 'order.closed';
    const REFUND_SUCCEEDED = 'refund.succeeded';
}