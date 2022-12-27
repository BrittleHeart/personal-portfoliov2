<?php

namespace App\Exception;

class NotImplementedException extends \Exception
{
    public function __construct(string $method)
    {
        parent::__construct("Method ${method} Not implemented yet");
    }
}