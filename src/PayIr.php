<?php
/**
 * User: wmateam
 * Date: 7/8/17
 * Time: 7:52 PM
 */

namespace wmateam\payIr;

use wmateam\curling\CurlRequest;

class PayIr
{
    /**
     * @var \stdClass $handler curl request handler
     */
    protected $handler;
    /**
     * @var null|string $base base url
     */
    protected $base = null;
    /**
     * @var null|string apiKey api key from pay.ir
     */
    protected $apiKey = null;
    /**
     * @var null|string redirectUrl post payment data after user payment
     */
    protected $redirectUrl = null;
    /**
     * @const GATE payment gateWay
     */
    const GATE = 'https://pay.ir/payment/';
    /**
     * @const SANDBOX  payment sandbox
     */
    const SANDBOX = self::GATE . 'test/';

    /**
     * PayIr constructor.
     *
     * @this PayIr
     * @param string $apiKey
     * @param string $redirectUrl
     * @param bool $testMode "use sandBox"
     */
    public function __construct($apiKey, $redirectUrl, $testMode = false)
    {
        $this->apiKey = $apiKey;
        $this->redirectUrl = $redirectUrl;
        if ($this->apiKey == 'test')
            $testMode = true;
        if ($testMode) $this->base = self::SANDBOX;
        else $this->base = self::GATE;
        return $this;
    }

    /**
     * @param array $params "Post parameters as array"
     * @return array
     */
    protected function postBody($params)
    {
        return array_merge($params, ['api' => $this->apiKey]);
    }

    /**
     * @param $response
     * @throws PayirException
     */
    protected function interceptor($response, $type)
    {
        if (is_null($response))
            throw new PayirException('jsonResponse is null', PayirException::INTERNAL_ERROR, null, $type);
        if (!$response->status)
            throw new PayirException($response->errorMessage, $response->errorCode, null, $type);
    }

    /**
     * @param integer $amount
     * @param (null|integer|string) $factorNumber
     * @return PayIrTransaction
     */
    public function newPayment($amount, $factorNumber = null)
    {
        $this->handler = new CurlRequest($this->base . 'send');
        $response = $this->handler->post($this->postBody([
            'amount' => $amount,
            'redirect' => $this->redirectUrl,
            'factorNumber' => $factorNumber
        ]));
        $jsonResponse = $response->getJson();
        $this->interceptor($jsonResponse, PayirException::NEW_PAYMENT);
        return new PayIrTransaction($jsonResponse->transId, $this->base);
    }

    /**
     * @param integer $transactionId
     * @return object
     */
    public function verifyPayment($transactionId)
    {
        $this->handler = new CurlRequest($this->base . 'verify');
        $response = $this->handler->post($this->postBody([
            'transId' => $transactionId,
        ]));
        $jsonResponse = $response->getJson();
        $this->interceptor($jsonResponse, PayirException::VERIFY_PAYMENT);
        return (object)[
            'status' => $jsonResponse->status,
            'amount' => intval($jsonResponse->amount)
        ];
    }
}