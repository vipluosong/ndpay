<?php

namespace Ndpay\Ndpay;

class base {
    /* @var $order order:class */
    public $order;
    /* @var $refund refund:class */
    public $refund;
    /* @var $receiver receiver:class */
    public $receiver;
    /* @var $transfer transfer:class */
    public    $transfer;
    protected $config  = [
        'appId' => '', // 应用ID
        'mchNo' => '', // 商户号
        'key'   => '', // 密钥
    ];
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
}