<?php

namespace Ndpay\Ndpay;

class base {
    public    $order;
    public    $refund;
    public    $receiver;
    public    $transfer;
    protected $config  = [];
    protected $head    = [
        'currency' => 'cny',
        'version'  => '1.0',
        'signType' => 'MD5',
        'reqTime'  => '',
    ];
    protected $appkey;
    private   $baseUrl = 'https://pay.jeepay.vip/api';

    /**
     * @throws \Exception
     */
    protected function request($url, array $params, $method = 'POST')
    {
        if (!$this->appkey) {
            throw new \Exception('密钥不能为空!');
        }
        $headers      = ['Accept' => 'application/json'];
        $options      = [];
        $url          = $this->baseUrl . $url;
        $data         = array_merge($this->config, $this->head, $params, ['reqTime' => (string)time()]);
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