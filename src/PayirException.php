<?php
/**
 * User: afkari
 * Date: 7/17/17
 * Time: 12:58 AM
 */
namespace wmateam\payIr;

use Exception;

class PayirException extends Exception
{
    const NEW_PAYMENT = 0;
    const VERIFY_PAYMENT = 1;
    const INTERNAL_ERROR = -1;
    const NEW_PAYMENT_ERROR = [
        -1 => 'Api is required',
        -2 => 'Amount is required',
        -3 => 'Amount must be a digits',
        -4 => 'Amount must be greater than 1000 rial',
        -5 => 'Redirect url is required',
        -6 => 'Api and Gateway are different',
        -7 => 'Dealer is disabled',
        'failed' => 'Failed transaction',
        0 => 'Api is required'
    ];
    const VERIFY_PAYMENT_ERROR = [
        -1 => 'Api is required',
        -2 => 'Transaction ID (transId) is required',
        -3 => 'Api and Gateway are different',
        -4 => 'Dealer is disabled',
        -5 => 'Failed transaction',
    ];

    /**
     * PayirException constructor.
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     * @param integer $type
     */
    public function __construct($message, $code, Exception $previous = null, $type = PayirException::NEW_PAYMENT)
    {
        if ($type === self::NEW_PAYMENT && !empty(self::NEW_PAYMENT_ERROR[$code])) {
            parent::__construct(self::NEW_PAYMENT_ERROR[$code], $code, $previous);
        } else if ($type === self::VERIFY_PAYMENT && !empty(self::VERIFY_PAYMENT_ERROR[$code])) {
            parent::__construct(self::VERIFY_PAYMENT_ERROR[$code], $code, $previous);
        } else if ($code === self::INTERNAL_ERROR) {
            parent::__construct('Internal Error', $code, $previous);
        } else {
            parent::__construct($message, $code, $previous);
        }
    }
}