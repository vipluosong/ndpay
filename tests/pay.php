<?php

namespace Ndpay\tests;

use Ndpay\Ndpay\ndpay;
class pay {
    public $pay;

    public function __construct()
    {
        $this->pay = new ndpay(['appId'=>'应用ID','mchNo'=>'商户号','key'=>'密钥']);
    }

    public function pay()
    {
        $this->pay->order->orderUnify([]);
    }

    public function query()
    {
        $this->pay->order->queryMchOrderNo('1212121212');
    }

    public function close()
    {
        $this->pay->order->closeMchOrderNo('1212121212');
    }
}