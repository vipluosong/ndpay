<?php

namespace Ndpay\Ndpay;

class transfer
{
    protected $base;

    public function __construct(base $base) {
        $this->base = $base;
    }

    protected function transferOrder(array $params)
    {
        $params['currency'] = 'cny';
        return $this->base->request('/transferOrder', $params);
    }

    protected function queryNchOrderNo(string $mchOrderNo)
    {
        return $this->transferQuery(['mchOrderNo' => $mchOrderNo]);
    }

    protected function queryTransferId(string $transferId)
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
    protected function queryBalance(array $params)
    {
        return $this->base->request('/transfer/balance/query', $params);
    }
}