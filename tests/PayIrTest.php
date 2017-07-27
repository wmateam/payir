<?php
/**
 * User: wmateam
 * Date: 7/8/17
 * Time: 7:52 PM
 */

use wmateam\payIr\PayIr;

class PayIrTest extends PHPUnit_Framework_TestCase
{
    const AMOUNT = 1000;
    const API_KEY = 'test';
    protected $payIr;

    /**
     * PayIrTest constructor.
     */
    public function __construct()
    {
        $this->payIr = new PayIr(self::API_KEY, 'http://localhost');
    }


    public function testNewPayment()
    {
        $transaction = $this->payIr->newPayment(self::AMOUNT);

        $this->assertTrue(is_int($transaction->getTransactionID()));
        $this->assertTrue(is_string($transaction->getGateway()));
        $this->verify($transaction->getTransactionID());
    }

    protected function verify($transactionID)
    {
        $verify = $this->payIr->verifyPayment($transactionID);
        $this->assertTrue(is_int($verify->status));
        $this->assertTrue(is_int($verify->amount));
        $this->assertEquals(self::AMOUNT, $verify->amount);
    }
}