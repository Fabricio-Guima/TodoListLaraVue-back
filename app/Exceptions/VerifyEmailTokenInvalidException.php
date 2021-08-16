<?php

namespace App\Exceptions;

use Exception;

class VerifyEmailTokenInvalidException extends Exception
{
    protected $message = 'Token not valid.';

    public function render(){
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->message

        ], status: 400);       
        
    }
}
