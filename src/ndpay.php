<?php
namespace Ndpay\Ndpay;

class ndpay  extends base
{
    use order;
    use refund;
    use transfer;
    use receiver;

    public function __construct($config)
    {
        $this->appkey = $config['key'];
        unset($config['key']);
        $this->config = $config;
    }
}