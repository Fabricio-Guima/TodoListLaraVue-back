<?php

namespace App\Http\Controllers;

use App\Http\Requests\todoStoreRequest;
use App\Http\Requests\TodoTaskStoreRequest;
use App\Http\Requests\TodoUpdateRequest;
use App\Http\Resources\TodoResource;
use App\Http\Resources\TodoTaskResource;
use App\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');

    }
  
    public function index(){

       
        return  TodoResource::collection(auth()->user()->todos);

    }

      public function show(Todo $todo){

        //autorizo isso se o id que eu to recebendo ($todo) for igual ao do view
        $this->authorize( 'view', $todo);

        //carregando as tasks relacionadas a um todo (seu id) e injetando no resource
        $todo->load('tasks');

       
        return  new TodoResource($todo);
    }


    public function store(todoStoreRequest $request){

        $input = $request->validated();
        $todo = auth()->user()->todos()->create($input);

       
        return new TodoResource($todo);

    }

    //esse todo vira do tipo model e por isso eu posso salvar com o fill a todo do front
    public function update(Todo $todo, TodoUpdateRequest $request){

        $this->authorize( 'update', $todo);

        $input = $request->validated();

        $todo->fill($input);
        $todo->save();

        //retorna a todo mais atualizada possível
      return new TodoResource($todo->fresh());

    }

    public function destroy(Todo $todo){

        $this->authorize( 'destroy', $todo);
        
        $todo->delete();

    }

    public function addTask(Todo $todo, TodoTaskStoreRequest $request){


         $this->authorize( 'addTask', $todo);

        $input = $request->validated();

        $todoTask = $todo->tasks()->create($input);

        return new TodoTaskResource($todoTask);

    }
}
