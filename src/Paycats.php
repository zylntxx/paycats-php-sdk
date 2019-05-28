<?php

declare(strict_types=1);

namespace Cmzz\Paycats;

use Cmzz\Paycats\Exceptions\HttpException;
use Cmzz\Paycats\Exceptions\InvalidConfigException;
use Cmzz\Paycats\Exceptions\InvalidSignatureException;
use Cmzz\Requests\Request;
use Symfony\Component\HttpFoundation\Response;

class Paycats
{
    private $config;
    private $apiUrl = 'https://api.paycats.cn/v1/';

    private $headers = [];
    private $options = [];

    /** @var Request */
    private $request;

    /**
     * Paycats constructor.
     * @param array $config
     * @throws InvalidConfigException
     */
    public function __construct(array $config)
    {
        if (!isset($config['key'])) {
            throw new InvalidConfigException('MissingParameter: key');
        }

        if (!isset($config['mch_id'])) {
            throw new InvalidConfigException('MissingParameter: mch_id');
        }

        $this->config = $config;
    }

    /**
     * 设置自定义的请求头部
     * @param array $headers
     */
    public function setHttpHeaders(array $headers)
    {
        $this->headers = array_merge($this->headers, $headers);
    }

    /**
     * 设置请求参数
     * @param array $options
     */
    public function setHttpOptions(array $options)
    {
        $this->options = array_merge($this->options, $options);
    }

    /**
     * 发起请求
     * @param Request $request
     * @return array
     * @throws HttpException
     */
    public function exec(Request $request): array
    {
        $api = $request->getApi();
        $data = $request->getData();
        $method = $request->getMethod();

        $url = $this->apiUrl. $api;

        if (!isset($data['mch_id'])) {
            $data['mch_id'] = $this->config['mch_id'];
        }

        if (!isset($data['sign'])) {
            $data['sign'] = Signature::make($data, $this->config['key']);
        }

        if ($request->isRedirect()) {
            $this->doRedirect($url, $data);
        } else {
            return $this->doRequest($url, $method, $data);
        }
    }

    /**
     * 处理通知请求
     * @param callable $callback
     * @return Response
     * @throws InvalidSignatureException
     */
    public function serve(callable $callback): Response
    {
        $data = $_POST;

        if (isset($data['sign'])) {
            if (!Signature::verify($data, $this->config['key'])) {
                throw new InvalidSignatureException('签名错误');
            }
        }

        try {
            $ret = $callback($data);

            if ($ret) {
                return new Response('success', 200);
            }
        } catch (\Exception $e) {
            // no code
        }

        return new Response('fail', 500);
    }

    /**
     * 执行跳转
     * @param string $url
     * @param array $data
     */
    private function doRedirect(string $url, array $data)
    {
        $url = sprintf('%s?%s', $url, http_build_query($data));

        echo '<script>location.href="'.$url.'"</script>';
        return ;
    }

    /**
     * 发起请求
     * @param string $url
     * @param string $method
     * @param array $data
     * @return array
     * @throws HttpException
     */
    private function doRequest(string $url, string $method, array $data): array
    {
        try {
            switch ($method) {
                case \Requests::POST:
                    $response = \Requests::POST($url, $this->headers, $data, $this->options);
            }

            /** @var \Requests_Response $response */
            if ($response && $response->status_code === 200) {
                $data = json_decode($response->body, true);

                if (isset($data['sign'])) {
                    if (!Signature::verify($data, $this->config['key'])) {
                        throw new InvalidSignatureException('签名错误');
                    }
                }

                return $data;
            }

            throw new HttpException('接口请求失败');
        } catch (\Exception $exception) {
            throw new HttpException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }
}