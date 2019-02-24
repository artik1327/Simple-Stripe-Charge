<?php

/**
 * Class Curl
 */
class Curl
{
    /**
     * @var resource
     */
    private $ch;

    /**
     * @var bool
     */
    private $response = false;

    /**
     * Curl constructor.
     * @param string $url
     * @param string $options
     * @param string $auth
     */
    public function __construct(string $url, string $options, string $auth)
    {

        $this->ch = curl_init($url);

        //Sets curl funtions parameters
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $options);

        curl_setopt($this->ch, CURLOPT_POST, 1);

        curl_setopt($this->ch, CURLOPT_USERPWD, $auth);

        $this->setHeaders();

    }

    /**
     * Gets responses from generated curl function
     *
     * @return string
     */
    public function getResponse(): string
    {
        if ($this->response) {
            return $this->response;
        }


        $response = curl_exec($this->ch);
        $error = curl_error($this->ch);
        $errno = curl_errno($this->ch);

        if (is_resource($this->ch)) {
            curl_close($this->ch);
        }

        if (0 !== $errno) {
            throw new \RuntimeException($error, $errno);
        }

        return $this->response = $response;
    }


    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getResponse();
    }


    /**
     * Creates headers
     */
    public function setHeaders()
    {
        $headers = [];
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
    }
}