<?php
namespace Ndpay\Ndpay;

class ndpay  extends base
{
    use order;
    use refund;
    use transfer;
    use receiver;

    public function __construct($config, $key)
    {
        $this->appkey = $key;
        $this->config = $config;
    }
}