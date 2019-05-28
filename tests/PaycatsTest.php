<?php

declare(strict_types=1);

namespace Cmzz\Paycats\Tests;

use Cmzz\Paycats\Exceptions\InvalidArgumentException;
use Cmzz\Paycats\Exceptions\InvalidConfigException;
use Cmzz\Paycats\Paycats;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

class PaycatsTest extends TestCase
{

    /** @var Paycats */
    protected $paycats;
    protected $config;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $_POST = [];
        $this->config = [
            'mch_id' => 123,
            'key' => '23848adkff'
        ];
        $this->paycats = new Paycats($this->config);
    }

    public function testPaycatsConfigCheck()
    {
        $p = new Paycats($this->config);

        $this->assertInstanceOf(Paycats::class, $p);
    }

    public function testPaycatsConfigCheckException()
    {
        $this->expectException(InvalidConfigException::class);

        $config = [];
        new Paycats($config);
        $this->fail('Failed to assert paycats throw excetion with empty config');

        new Paycats(['key' => '1234']);
        $this->fail('Failed to assert paycats throw excetion without mch_id');

        new Paycats(['mch_id' => 1234]);
        $this->fail('Failed to assert paycats throw excetion without key');
    }

    public function testWebHookServeResponse()
    {
        $_POST = [

        ];

        $response = $this->paycats->serve(function ($data) {
            return true;
        });
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testWebHookReturnFail()
    {
        $_POST = [

        ];

        $response = $this->paycats->serve(function ($data) {
            return false;
        });

        $this->assertEquals(500, $response->getStatusCode());
        $this->assertEquals('fail', $response->getContent());
    }

    public function testWebHookReturnSuccess()
    {
        $_POST = [

        ];

        $response = $this->paycats->serve(function ($data) {
            return false;
        });

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('success', $response->getContent());
    }

    public function testNativePay()
    {

    }
}