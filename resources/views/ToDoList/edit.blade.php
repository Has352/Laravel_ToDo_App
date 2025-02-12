{{-- resources/views/todolists/edit.blade.php --}}
@extends('layouts.app')
@section('title', 'تعديل القائمة')
@section('content')
<div class="container">
    <h1>تعديل القائمة</h1>
    <form action="{{ route('todolist.update', $todoList->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">اسم القائمة</label>
            <input type="text" name="name" class="form-control" value="{{ $todoList->name }}" required>
        </div>
        <button type="submit" class="btn btn-success">حفظ التعديلات</button>
    </form>
</div>
@endsection