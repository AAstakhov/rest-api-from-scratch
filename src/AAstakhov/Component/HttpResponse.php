<?php

namespace AAstakhov\Component;

use AAstakhov\Interfaces\HttpResponseInterface;

class HttpResponse implements HttpResponseInterface
{
    /**
     * Response body
     *
     * @var string
     */
    private $body;
    /**
     * Array of status code and status message
     *
     * @var array
     */
    private $status = [200, 'OK'];

    public function setBody($text)
    {
        $this->body = $text;
    }

    public function setStatusCode($code)
    {
        switch ($code) {
            case 400:
                $this->status = [400, 'Bad Request'];
                break;
            case 404:
                $this->status = [404, 'Not Found'];
                break;
            case 500:
                $this->status = [500, 'Internal Server Error'];
                break;
        };
    }

    public function send()
    {
        header(sprintf('HTTP/1.1 %d %s', $this->getStatusCode(), $this->getStatusMessage()));
        header('Content-Type: application/json; charset=UTF-8');

        print $this->body;
    }

    public function getStatusCode()
    {
        return $this->status[0];
    }

    public function getStatusMessage()
    {
        return $this->status[1];
    }
}