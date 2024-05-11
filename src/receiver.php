<?php

namespace Ndpay\Ndpay;

class receiver
{
    protected $base;

    public function __construct(base $base) {
        $this->base = $base;
    }
    protected function bind(array $params)
    {
        return $this->base->request('/division/receiver/bind', $params);
    }

    protected function exec(array $params)
    {
        return $this->base->request('/division/exec', $params);
    }

    protected function balanceCashout(array $params)
    {
        return $this->base->request('/division/receiver/channelBalanceCashout', $params);
    }

    protected function balanceQuery(array $params)
    {
        return $this->base->request('/division/receiver/channelBalanceQuery', $params);
    }
}