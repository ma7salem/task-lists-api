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
        'details',
        'start_at',
        'status',
        'todo_list_id',
        'label_id'
    ];

    public function todoList(): BelongsTo
    {
        return $this->belongsTo(TodoList::class);    
    }

    public function label(): BelongsTo
    {
        return $this->belongsTo(Label::class);    
    }

    public function getIsScheduleAttribute(): bool
    {
        return $this->start_at ? true : false;    
    }
}
