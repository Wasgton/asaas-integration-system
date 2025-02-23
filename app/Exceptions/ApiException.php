<?php

namespace App\Exceptions;

use Exception;

class ApiException extends Exception
{
    
    protected $statusCode;

    public function __construct(string $message = "", int $statusCode = 400, Exception $previous = null)
    {
        parent::__construct($message, $statusCode, $previous);
        $this->statusCode = $statusCode;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'error'       => true,
            'message'     => $this->getMessage(),
            'code'        => $this->getCode(),
            'status_code' => $this->getStatusCode()
        ];
    }
}
