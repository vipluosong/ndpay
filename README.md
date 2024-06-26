# 牛盾聚合支付介绍
>### 最新最全的聚合支付SDK
> 全场景支付涵盖（微信、支付宝、小程序、H5、PC、APP、公众号、生活号、线下扫码、人脸识别（微信/支付宝）、扫码POS、云喇叭、扫码枪、扫码盒）等等,一套接口全部完成

>🚀 接口文档地址: https://ndpay.qyyapp.com
>
>🚀 在线调试文档: https://ndpay-apidoc.apifox.cn
>
>🚀 点击访问: https://www.jeequan.com/demo/jeepay_cashier.html

## 牛盾聚合支付和传统支付对比
|   功能    | 牛盾聚合支付 | 传统支付（微信&支付宝） | 说明                    |
|:-------:|:------:|:------------:|-----------------------|
| 统一商户进件  |   ✅    |      ❌       | 意见开通微信、支付宝商户号         |
| 统一接口对接  |   ✅    |      ❌       | 一套接口支持微信、支付宝、云闪付      |
| 统一财务对账  |   ✅    |      ❌       |                       |
| 快速进件审核  |   ✅    |      ❌       |                       |
| 技术协助对接  |   ✅    |      ❌       |                       |
| 客服协助进件  |   ✅    |      ❌       |                       |
| 接口分账支持  |   ✅    |      ❌       | 需单独申请需单独申请需单独申请       |
| 商户对私结算  |   ✅    |      ❌       |                       |
| 商户D+1结算 |   ✅    |      ❌       | 法定节假日照常结算             |
| 接口支付安全  |   ✅    |      ✅       | 支付通道通过微信、支付宝和中国支付协会备案 |
| 普通个人进件  |   ✅    |      ❌       |                       |
| 支付风控等级  |   中    |      高       |                       |


## 一套接口多场景多通道支持
> **场景支持**：支持微信、支付宝、H5、PC、APP、公众号、生活号、线下扫码、人脸识别（微信/支付宝）、扫码POS、云喇叭、扫码枪、扫码盒
> **多通道**：微信支付、支付宝、云闪付、盛付通、斗拱支付、拉卡拉、富友支付、工商银行、建设银行、银盛支付
> **支付接口**：转账、提现、分账、查单、退款、回调

## 进件类型
>🚀 个人进件、个体户进件、企业进件、政府进件

## json参数说明
|参数名|参数值|说明|
| :--- | :--- | :--- |
|appConf|{"appId":"","mchNo":"","serce":""}|商户ID、商户号、密钥|
|domain|https://您的服务域名地址|domain的作用请见|

## uniapp demo
>https://ndpay.qyyapp.com/demo/#uniapp-demo
## app-demo
>https://ndpay.qyyapp.com/demo/#app-demo
## php-demo
>https://ndpay.qyyapp.com/demo/#php-demo
## java-demo
>https://ndpay.qyyapp.com/demo/#java-demo

# 技术支持
- 技术支持请联系：`18612332342` （微信同号） 或者 添加 QQ： `775169431`


## php 代码实现
``` php
use Ndpay\Ndpay\ndpay;

// 参数接口文档 https://ndpay.qyyapp.com/api/1.%E6%94%AF%E4%BB%98%E6%8E%A5%E5%8F%A3/1.html#%E8%AF%B7%E6%B1%82%E5%8F%82%E6%95%B0
$pay = new ndpay(['appId'=>'应用ID','mchNo'=>'商户号'],'密钥');

//支付接口
$pay->order->orderUnify([]);

// 通过订单号查询
$this->pay->order->queryMchOrderNo('订单号');

// 通过订单号关闭
$this->pay->order->closeMchOrderNo('订单号');

// 通过订单号关闭
$this->pay->order->closeMchOrderNo('订单号');

// 订单退款
$this->pay->refund->refundOrder([]);

// 订单退款查询
$this->pay->refund->queryMchRefundNo([]);

// 订单转账
$this->pay->transfer->transferOrder([]);
```