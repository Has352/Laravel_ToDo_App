<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ToDoList extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id', "created_at"]; // السماح بتعبئة هذه الحقول

    // علاقة القائمة بالمهام (كل قائمة تحتوي على مهام متعددة)
    public function tasks()
    {
        return $this->hasMany(Task::class, 'todo_list_id');
    }

    // علاقة القائمة بالمستخدم (كل قائمة تابعة لمستخدم معين)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
