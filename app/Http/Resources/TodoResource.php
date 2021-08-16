<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TodoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        //todo tem varias tasks e só irei fazer tudo ficar pronto quando as tasks forem pegas no banco
        return [
            'id' => (integer)$this->id,
            'label' => (string)$this->label,
            'created_at' => (string)$this->created_at,
            'update_at' => (string)$this->update_at,
            'tasks' =>  TodoTaskResource::collection($this->whenLoaded('tasks'))
        ];
    }
}
