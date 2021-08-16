<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoTaskUpdateRequest;
use App\Http\Resources\TodoTaskResource;
use App\TodoTask;
use Illuminate\Http\Request;

class TodoTaskController extends Controller
{

    public function __construct() 
    {

        $this->middleware('auth:api');
        
    }

    public function update(TodoTask $todoTask,TodoTaskUpdateRequest $request){

        $this->authorize( 'update', $todoTask);
        $input = $request->validated();

        $todoTask->fill($input);
        $todoTask->save();

        return new TodoTaskResource($todoTask);

    }

    public function destroy(TodoTask $todoTask){

        $this->authorize( 'destroy', $todoTask);
        
        $todoTask->delete();

    }
}
