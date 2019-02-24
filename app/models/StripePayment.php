<?php

require_once 'Curl.php';

/**
 * Class StripePayment
 */
class StripePayment
{

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $amount;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $source;

    /**
     * @var string
     */
    private $postFields;

    /**
     * @var string
     */
    private $message;

    /**
     * Sets default Stripe charge endpoint
     *
     * StripePayment constructor.
     */
    public function __construct()
    {
        $this->url = 'https://api.stripe.com/v1/charges';
    }

    /**
     * @param string $token
     */
    public function setToken(string $token)
    {
        $this->token = $token . ':';
    }

    /**
     * @param string $amount
     */
    public function setAmount(string $amount)
    {
        $this->amount = $amount;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency)
    {
        $this->currency = $currency;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @param string $source
     */
    public function setSource(string $source)
    {
        $this->source = $source;
    }


    /**
     * Generates Post fields for cURL function
     */
    public function preparePostFields()
    {
        $this->postFields = 'currency=' . $this->currency .
            '&description=' . $this->description .
            '&source=' . $this->source .
            '&amount=' . $this->amount;
    }

    /**
     * Gets Stripe charge response message
     *
     * @param string $response
     */
    private function setMessage(string $response)
    {
        $response = json_decode($response);
        $this->message = $response->outcome->seller_message;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Makes Stripe charge
     */
    public function chargePayment()
    {
        $this->preparePostFields();

        $charge = new Curl($this->url, $this->postFields, $this->token);
        $response = $charge->getResponse();

        file_put_contents('../resources/charge_result.txt', $response);
        $this->setMessage($response);

    }
}