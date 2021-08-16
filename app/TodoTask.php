<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TodoTask extends Model
{
    protected $fillable = [
        'label', 'is_complete'
    ];

    //todoTasks  pertence a um todo
    public function todo(){
        return $this->belongsTo(Todo::class);
    }
}
