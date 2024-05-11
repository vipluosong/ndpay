<?php

namespace Ndpay\Ndpay;

trait receiver
{
    public $receiver;
    public function __construct(){
        $this->receiver = new self();
    }
    protected function bind(array $params)
    {
        return $this->request('/division/receiver/bind', $params);
    }

    protected function exec(array $params)
    {
        return $this->request('/division/exec', $params);
    }

    protected function balanceCashout(array $params)
    {
        return $this->request('/division/receiver/channelBalanceCashout', $params);
    }

    protected function balanceQuery(array $params)
    {
        return $this->request('/division/receiver/channelBalanceQuery', $params);
    }
}