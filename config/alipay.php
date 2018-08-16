<?php

return [
    'alipay'=>[
        'app_id' => '2018022702283497',
        'method' => 'alipay.trade.wap.pay',
        'return_url' => 'https://www.ziransha.shop/alipay/return.php', //同步地址
        'charset' => 'utf-8',
        'sign_type' => 'RSA2',
        'timestamp' => date('Y-m-d H:i:s'),
        'version' => '1.0',
        'notify_url' => 'https://118.24.30.249/notify.php',
        'biz_content' => '',
    ]
];
?>