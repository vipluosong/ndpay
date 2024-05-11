<?php

namespace Ndpay\Ndpay;

class transfer
{
    protected $base;

    public function __construct(base $base) {
        $this->base = $base;
    }

    public function transferOrder(array $params)
    {
        $params['currency'] = 'cny';
        return $this->base->request('/transferOrder', $params);
    }

    public function queryNchOrderNo(string $mchOrderNo)
    {
        return $this->transferQuery(['mchOrderNo' => $mchOrderNo]);
    }

    public function queryTransferId(string $transferId)
    {
        return $this->transferQuery(['transferId' => $transferId]);
    }

    /**
     * @param array $params
     */
    private function transferQuery(array $params)
    {
        return $this->base->request('/transfer/query', $params);
    }

    /**
     * @param array $params
     */
    public function queryBalance(array $params)
    {
        return $this->base->request('/transfer/balance/query', $params);
    }
}