<h1 align="center"> paycats-php-sdk </h1>
<p align="center">支付猫个人支付官方 PHP SDK.</p>

## Requirement

1. PHP >= 7.0
2. **[Composer](https://getcomposer.org/)**


## Documentation

[官网](https://www.paycats.cn)  · [文档](https://www.paycats.cn/docs)  


## Installing

```shell
$ composer require cmzz/paycats-php-sdk -vvv
```

## Usage

### 发起支付

```php
<?php

use Cmzz\Paycats\Paycats;
use Cmzz\Paycats\Requests\NativeRequest;

$config = [
  'mch_id' => 'you app id',
  'key' => 'your api key'  
];
$paycats = new Paycats($config);

$data = [
  'out_order_no' => '1231111'  
];
$request = new NativeRequest($data);

try {
    $result = $paycats->exec($request);
} catch (\Cmzz\Paycats\Exceptions\Exception $exception) {
    // 异常
    echo $exception->getMessage();
}

if ($result['return_code'] === 0) {
    // 已经验证签名
    // 请求成功，业务逻辑
    // your code
}
```

### 接收 webhook 通知

```php
<?php

use Cmzz\Paycats\Paycats;

$config = [
  'mch_id' => 'you app id',
  'key' => 'your api key'  
];
$paycats = new Paycats($config);

$notifyData = $paycats->serve();

switch ($notifyData['notify_type']) {
    case \Cmzz\Paycats\NotifyType::ORDER_SUCCEEDED:
        // 订单支付成功通知
        
        break;
        
    case \Cmzz\Paycats\NotifyType::REFUND_SUCCEEDED:
        // 订单退款成功 
        
        break;
}

```

## License

MIT