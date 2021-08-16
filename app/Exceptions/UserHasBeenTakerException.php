<?php

namespace App\Exceptions;

use Exception;

class UserHasBeenTakerException extends Exception
{
    protected $message = 'User has been taken';

    public function render(){
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->message

        ], status: 400);       
        
    }
}
