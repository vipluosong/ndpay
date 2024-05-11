<?php

namespace Ndpay\Ndpay;

class order
{
    protected $base;

    public function __construct(base $base) {
        $this->base = $base;
    }

    public function orderUnify(array $params)
    {
        $params['currency'] = 'cny';
        return $this->base->request('/pay/unifiedOrder', $params);
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
        return $this->base->request('/pay/query', $params);
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
        return $this->base->request('/pay/close', $params);
    }

    public function bridgeConfig(array $data)
    {
        $data = isset($data['data']['payData']) ? $data['data']['payData'] : [];
        return json_decode($data,true);
    }
}