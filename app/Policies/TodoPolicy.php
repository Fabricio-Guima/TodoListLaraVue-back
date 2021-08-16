<?php

namespace App\Policies;

use App\Todo;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TodoPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

     public function view(User $user,Todo $todo) {

        return  $user->id === $todo->user_id;
            
        }

    public function update(User $user,Todo $todo) {

        return  $user->id === $todo->user_id;
            
        } 
        
    public function destroy(User $user,Todo $todo) {

        return  $user->id === $todo->user_id;
            
        }  

     public function addTask(User $user,Todo $todo) {

        return  $user->id === $todo->user_id;
            
        }    
}
