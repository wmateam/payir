<?php
/**
 * User: afkari
 * Date: 7/17/17
 * Time: 1:37 AM
 */
namespace wmateam\payIr;

class PayIrTransaction
{
    protected $transactionID = null;
    protected $gateway = null;

    /**
     * PayIrTransaction constructor.
     * @param number|string $transactionID "Transaction ID"
     * @param string $gateway "Gateway"
     */
    public function __construct($transactionID, $gateway)
    {
        $this->transactionID = $transactionID;
        $this->gateway = $gateway . 'gateway/' . $this->transactionID;
    }

    /**
     * @return string
     */
    public function getTransactionID()
    {
        return $this->transactionID;
    }

    /**
     * @return  string
     */
    public function getGateway()
    {
        return $this->gateway;
    }


}