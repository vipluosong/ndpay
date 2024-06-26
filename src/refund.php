<?php

namespace Ndpay\Ndpay;

class refund
{
    protected $base;

    public function __construct(base $base) {
        $this->base = $base;
    }

    public function refundOrder(array $params)
    {
        $params['currency'] = 'cny';
        return $this->base->request('/refund/refundOrder', $params);
    }

    public function queryMchRefundNo(string $mchRefundNo,$data)
    {
        return $this->refundQuery(array_merge(['mchRefundNo' => $mchRefundNo],$data));
    }

    public function queryRefundOrderId(string $refundOrderId,$data)
    {
        return $this->refundQuery(array_merge(['refundOrderId' => $refundOrderId],$data));
    }

    /**
     * @param array $params
     */
    private function refundQuery(array $params)
    {
        return $this->base->request('/refund/query', $params);
    }
}