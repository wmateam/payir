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
    const API_IS_REQUIRED = -1;
    const AMOUNT_IS_REQUIRED = -2;
    const AMOUNT_MUST_BE_A_DIGITS = -3;
    const AMOUNT_MUST_GREATER_THAN_1000 = -4;
    const REDIRECT_IS_REQUIRED = -5;
    const INVALID_API_OR_GATEWAY = -6;
    const DEALER_IS_DISABLED = -7;
    const FAILED_TRANACTION = 'failed';
    const INTERNAL_ERROR = 0;

    public function __construct($message, $code, Exception $previous = null)
    {
        switch ($code) {
            case self::API_IS_REQUIRED:
                parent::__construct('Api is required', $code, $previous);
                break;
            case self::AMOUNT_IS_REQUIRED:
                parent::__construct('Amount is required', $code, $previous);
                break;
            case self::AMOUNT_MUST_BE_A_DIGITS:
                parent::__construct('Amount must be a digits', $code, $previous);
                break;
            case self::AMOUNT_MUST_GREATER_THAN_1000:
                parent::__construct('Amount must be greater than 1000 rial', $code, $previous);
                break;
            case self::REDIRECT_IS_REQUIRED:
                parent::__construct('Redirect url is required', $code, $previous);
                break;
            case self::INVALID_API_OR_GATEWAY:
                parent::__construct('Api and Gateway are different', $code, $previous);
                break;
            case self::DEALER_IS_DISABLED:
                parent::__construct('Dealer is disabled', $code, $previous);
                break;
            case self::FAILED_TRANACTION:
                parent::__construct('Failed transaction', $code, $previous);
                break;
            case self::INTERNAL_ERROR:
                parent::__construct($message, $code, $previous);
                break;
            default:
                parent::__construct($message, $code, $previous);
                break;
        }
    }
}