<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['titel', 'description', 'completed', 'todo_list_id']; // السماح بتعبئة هذه الحقول

    // علاقة المهمة بالقائمة (كل مهمة تابعة لقائمة واحدة)
    public function todoList()
    {
        return $this->belongsTo(TodoList::class, 'todo_list_id');
    }
}
