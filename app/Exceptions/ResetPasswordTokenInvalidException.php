<?php

namespace App\Exceptions;

use Exception;

class ResetPasswordTokenInvalidException extends Exception
{
    protected $message = 'Reset password not valid.';

    public function render(){
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->message

        ], status: 400);       
        
    }
}
