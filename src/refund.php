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

    protected function refundNotice($data)
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