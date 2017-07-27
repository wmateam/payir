<?php
/**
 * User: afkari
 * Date: 7/17/17
 * Time: 1:37 AM
 */
namespace wmateam\payIr;

class PayIrReceipt
{
    /**
     * @var integer
     */
    protected $status = null;
    /**
     * @var integer
     */
    protected $transactionId = null;
    /**
     * @var (null|integer|string)
     */
    protected $factorNumber = null;
    /**
     * @var string
     */
    protected $cardNumber = null;
    /**
     * @var string
     */
    protected $message = null;

    /**
     * PayIrReceipt constructor.
     * @param int $status
     * @param int $transactionId
     * @param null $factorNumber
     * @param string $cardNumber
     * @param string $message
     */
    public function __construct($status, $transactionId, $factorNumber, $cardNumber, $message)
    {
        $this->status = $status;
        $this->transactionId = $transactionId;
        $this->factorNumber = $factorNumber;
        $this->cardNumber = $cardNumber;
        $this->message = $message;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * @return mixed
     */
    public function getFactorNumber()
    {
        return $this->factorNumber;
    }

    /**
     * @return string
     */
    public function getCardNumber()
    {
        return $this->cardNumber;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    public function isSuccessful()
    {
        return $this->status === 1;
    }
}