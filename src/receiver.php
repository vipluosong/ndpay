<?php

namespace Ndpay\Ndpay;

class receiver
{
    protected $base;

    public function __construct(base $base) {
        $this->base = $base;
    }
    public function bind(array $params)
    {
        return $this->base->request('/division/receiver/bind', $params);
    }

    public function exec(array $params)
    {
        return $this->base->request('/division/exec', $params);
    }

    public function balanceCashout(array $params)
    {
        return $this->base->request('/division/receiver/channelBalanceCashout', $params);
    }

    public function balanceQuery(array $params)
    {
        return $this->base->request('/division/receiver/channelBalanceQuery', $params);
    }
}