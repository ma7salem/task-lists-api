<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'todo_list_id'
    ];

    public function todoList(): BelongsTo
    {
        return $this->belongsTo(TodoList::class);    
    }
}
