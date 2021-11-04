<?php

namespace App\Exceptions;

use Exception;

class EditException extends Exception
{
    /**
     * @var array
     */
    public $attributes = [];

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }
}