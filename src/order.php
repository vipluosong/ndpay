<?php

namespace Ndpay\Ndpay;

trait order
{
    public function __construct(){
        $this->order = new self();
    }

    public function orderUnify(array $params)
    {
        return $this->request('/pay/unifiedOrder', $params);
    }

    public function queryMchOrderNo(string $mchOrderNo)
    {
        return $this->orderQuery(['mchOrderNo' => $mchOrderNo]);
    }

    public function queryPayOrderId(string $payOrderId)
    {
        return $this->orderQuery(['payOrderId' => $payOrderId]);
    }

    /**
     * @param array $params
     */
    private function orderQuery(array $params)
    {
        return $this->request('/pay/query', $params);
    }

    public function closeMchOrderNo(string $mchOrderNo)
    {
        return $this->orderClose(['mchOrderNo' => $mchOrderNo]);
    }

    public function closePayOrderId(string $payOrderId)
    {
        return $this->orderClose(['payOrderId' => $payOrderId]);
    }

    /**
     * Close order by out_trade_no.
     *
     * @param string $tradeNo
     */
    public function orderClose(array $params)
    {
        return $this->request('/pay/close', $params);
    }

    public function orderNotice($data)
    {
        $sign = $data['sign'];
        unset($data['sign']);
        $sign1 = $this->sign($data);
        if ($sign1 !== $sign) {
            throw new \Exception('签名验证未通过');
        }
        return $data;
    }

    public function bridgeConfig(array $data)
    {
        $data = isset($data['data']['payData']) ? $data['data']['payData'] : [];
        return json_decode($data,true);
    }
}