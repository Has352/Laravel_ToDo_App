{{-- resources/views/tasks/create.blade.php --}}
@extends('layouts.app')
@section('title', 'إضافة مهمة')
@section('content')
<div class="container">
    <h1>إضافة مهمة جديدة</h1>
    <form action="{{ route('task.store', $todoListId) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">عنوان المهمة</label>
            <input type="text" name="titel" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">الوصف</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">إضافة</button>
    </form>
</div>
@endsection