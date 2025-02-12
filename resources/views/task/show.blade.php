{{-- resources/views/tasks/show.blade.php --}}
@extends('layouts.app')
@section('title', 'تفاصيل المهمة')
@section('content')
<div class="container">
    <h1>{{ $task->titel }}</h1>
    <p>{{ $task->description }}</p>
    <p>الحالة: {{ $task->completed ? 'مكتملة' : 'غير مكتملة' }}</p>
    <a href="{{ route('task.edit', [$todoList->id, $task->id]) }}" class="btn btn-warning">تعديل</a>
    <form action="{{ route('task.destroy', [$todoList->id, $task->id]) }}" method="POST" style="display:inline;">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-danger">حذف</button>
    </form>
</div>
@endsection