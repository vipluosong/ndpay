<?php

namespace Ndpay\Ndpay;

trait transfer
{
    public    $transfer;
    public function __construct()
    {
        $this->transfer = new self();
    }

    protected function transferOrder(array $params)
    {
        $params['currency'] = 'cny';
        return $this->request('/transferOrder', $params);
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
        return $this->request('/transfer/query', $params);
    }

    /**
     * @param array $params
     */
    protected function queryBalance(array $params)
    {
        return $this->request('/transfer/balance/query', $params);
    }
}