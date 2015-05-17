<?php
namespace AAstakhov\Interfaces;

interface HttpResponseInterface
{
    /**
     * Set response body
     *
     * @param string $text
     * @return $this
     */
    public function setBody($text);

    /**
     * Set HTTP status code
     *
     * @param int $code
     * @return $this
     */
    public function setStatusCode($code);

    /**
     * @return int
     */
    public function getStatusCode();

    /**
     * @return string
     */
    public function getStatusMessage();

    /**
     * Sends response
     */
    public function send();
}