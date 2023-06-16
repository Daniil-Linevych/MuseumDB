<?php

namespace core;

class Error
{
    public $errorCode;

    public function __construct($errorCode){
        $this->errorCode = $errorCode;
    }
}