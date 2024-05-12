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
    public function request($url, array $params)
    {
        $options      = [];
        $url          = $this->baseUrl . $url;
        $this->head['reqTime'] = (string)time();
        $data         = array_merge($this->config, $this->head, $params);
        $data['sign'] = $this->sign($data);
        $result = $this->curl($url,$data);
        $res          = json_decode($result, true);
        $code         = $res['code'];
        if ($code || isset($res['data']['errCode'])) {
            $msg = isset($res['data']['errMsg']) ? $res['data']['errMsg'] : $res['msg'];
            throw new \Exception($msg);
        }
        return $res;
    }

    private function curl($url,$data) {
        $data = json_encode($data, JSON_UNESCAPED_UNICODE);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Content-Length:' . strlen($data)));
        $result = curl_exec($curl);
        if(curl_errno($curl)) {
            throw new \Exception('Errno'.curl_errno($curl));
        }
        curl_close($curl);
        return $result;
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