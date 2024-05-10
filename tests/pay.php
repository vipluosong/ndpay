<?php

namespace Ndpay\tests;

use Ndpay\Ndpay\ndpay;

class pay {
    public $pay;

    public function __construct()
    {
        $key       = '密钥';
        $this->pay = new ndpay(['appId' => '应用ID', 'mchNo' => '商户号'], $key);
    }

    public function pay()
    {
        // 参数接口文档 https://ndpay.qyyapp.com/api/1.%E6%94%AF%E4%BB%98%E6%8E%A5%E5%8F%A3/1.html#%E8%AF%B7%E6%B1%82%E5%8F%82%E6%95%B0
        $this->pay->order->orderUnify([
            'mchOrderNo' => '订单号',
            'wayCode'    => '支付方式',
            'amount'     => '金额（分）',
            'subject'    => '商品标题',
            'body'       => '商品描述',
            // ...其他参数
        ]);
    }

    public function query()
    {
        // 通过订单号查询
        $this->pay->order->queryMchOrderNo('订单号');
        // 通过支付返回的支付单号查询
        $this->pay->order->queryPayOrderId('支付单号');
    }

    public function close()
    {
        // 通过订单号关闭
        $this->pay->order->closeMchOrderNo('订单号');
        // 通过支付返回的支付单号关闭
        $this->pay->order->closePayOrderId('订单号');
    }
}