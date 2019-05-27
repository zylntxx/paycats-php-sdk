<?php

declare(strict_types=1);


namespace Cmzz\Paycats;


class Api
{
    const BASE_API = 'https://api.paycats.cn/v1/';

    const NATIVE_PAY = 'pay/wx/native';
    const JSAPI_PAY = 'pay/alipay/jsapi';
    const F2F_PAY = 'pay/alipay/f2f';
    const CASHIER_PAY = 'pay/wx/cashier';
    const WX_OPENID = 'wx/openid';
    const WX_USER = 'wx/user';
    const QUERY_ORDER = 'order/query';
    const CLOSE_ORDER = 'order/close';
    const REVERSE_ORDER = 'order/reverse';
    const REFUND_ORDER = 'order/refund';
    const QUERY_BANK_INFO = 'bank';
}