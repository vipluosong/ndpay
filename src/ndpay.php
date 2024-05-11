<?php
namespace Ndpay\Ndpay;

class ndpay  extends base
{
    public $order;
    public $refund;
    public $transfer;
    public $receiver;

    public function __construct($config, $key) {
        parent::__construct($config, $key);
        $this->order = new order($this);
        $this->refund = new refund($this);
        $this->transfer = new transfer($this);
        $this->receiver = new receiver($this);
    }
}