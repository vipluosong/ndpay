<?php

namespace Ndpay\Ndpay;

trait refund
{
    public function __construct()
    {
        $this->refund = new self();
    }

    protected function refundOrder(array $params)
    {
        $params['currency'] = 'cny';
        return $this->request('/refund/refundOrder', $params);
    }

    protected function queryMchRefundNo(string $mchRefundNo,$data)
    {
        return $this->refundQuery(array_merge(['mchRefundNo' => $mchRefundNo],$data));
    }

    protected function queryRefundOrderId(string $refundOrderId,$data)
    {
        return $this->refundQuery(array_merge(['refundOrderId' => $refundOrderId],$data));
    }

    /**
     * @param array $params
     */
    private function refundQuery(array $params)
    {
        return $this->request('/refund/query', $params);
    }
}