<?php

declare(strict_types=1);

namespace Paycats\Sdk\Tests;

use Paycats\Sdk\Exceptions\InvalidSignatureException;
use Paycats\Sdk\Signature;
use PHPUnit\Framework\TestCase;

class SignatureTest extends TestCase
{
    /** @var array */
    protected $data;

    /** @var string */
    protected $key;

    /** @var string */
    protected $sign;

    public function setUp(): void
    {
        parent::setUp();

        $this->data = [
            'total_fee' => 100,
            'mch_id' => 1531528931,
            'out_order_no' => 1531528931
        ];

        $this->key = 'ISu49mvhpcS';

        // sign generated from https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=20_1
        $this->sign = '89A1F8E2CAEDB10102392B643B2318B8';
    }

    public function testMakeSign()
    {
        $this->assertEquals($this->sign, Signature::make($this->data, $this->key));
    }

    public function testVerifySign()
    {
        $this->assertTrue(Signature::verify($this->data, $this->key, $this->sign));

        $data = $this->data;
        $data['sign'] = $this->sign;
        $this->assertTrue(Signature::verify($data, $this->key));
    }

    public function testVerifySignException()
    {
        $this->expectException(InvalidSignatureException::class);
        Signature::verify($this->data, $this->key);

        $this->fail('Failed to assert signature throw exception with invalid argument.');
    }
}