[![Build Status](https://travis-ci.org/wmateam/payir.svg?branch=master)](https://travis-ci.org/wmateam/curling)
[![License](https://poser.pugx.org/wmateam/curling/license)](https://packagist.org/packages/wmateam/curling)
# Pay.ir php package
# [Wiki and Docs](https://github.com/wmateam/payir/wiki)

### New payment
```php
$apiKey = 'test';
$redirectUrl = 'http://localhost:2030/verify.php';
$payIr = new \wmateam\payIr\PayIr($apiKey, $redirectUrl);

$factorNumber = 'testFactorNumber';//Optional
$amount = 1000;//Rial

$transaction = $payIr->newPayment($amount, $factorNumber);
$transactionID = $transaction->getTransactionID();
$gateway = $transaction->getGateway();
```

### verify transaction
```php
$apiKey = 'test';
$redirectUrl = 'http://localhost:2030/verify.php';
$payIr = new \wmateam\payIr\PayIr($apiKey, $redirectUrl);

$verify = $payIr->verifyPayment($_POST['transId']);
$status = $verify->status;
$amount = $verify->amount;
```