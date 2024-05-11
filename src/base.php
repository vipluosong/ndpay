<?php

namespace Ndpay\Ndpay;

class base {
    protected $config  = [
        'appId' => '', // 应用ID
        'mchNo' => '', // 商户号
    ];
    protected $head    = [
        'version'  => '1.0',
        'signType' => 'MD5',
        'reqTime'  => '',
        'sign'     => '',
    ];
    protected $appkey; // 密钥
    private   $baseUrl = 'https://pay.jeepay.vip/api';

    public function __construct($config, $key) {
        $this->appkey = $key;
        $this->config = $config;
    }

    public function signCheck($data)
    {
        $sign = $data['sign'];
        unset($data['sign']);
        $sign1 = $this->sign($data);
        if ($sign1 !== $sign) {
            throw new \Exception('签名验证未通过');
        }
        return $data;
    }

    /**
     * @throws \Exception
     */
    public function request($url, array $params, $method = 'POST')
    {
        $headers      = ['Accept' => 'application/json'];
        $options      = [];
        $url          = $this->baseUrl . $url;
        $this->head['reqTime'] = (string)time();
        $data         = array_merge($this->config, $this->head, $params);
        $data['sign'] = $this->sign($data);
        $request      = \Requests::request($url, $headers, $data, $method, $options);
        $res          = json_decode($request->body, true);
        $code         = $res['code'];
        $errCode      = $res['data']['errCode'];
        if ($code || $errCode) {
            $msg = $res['data']['errMsg'] ?: $res['msg'];
            throw new \Exception($msg);
        }
        return $res;
    }

    protected function sign($paramArray)
    {
        ksort($paramArray);  //字典排序
        reset($paramArray);
        $md5str = "";
        foreach ($paramArray as $key => $val) {
            if (strlen($key) && strlen($val)) {
                $md5str = $md5str . $key . "=" . $val . "&";
            }
        }
        $sign = strtoupper(md5($md5str . "key=" . $this->appkey));  //签名
        return $sign;
    }
}