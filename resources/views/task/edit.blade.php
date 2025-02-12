{{-- resources/views/tasks/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'تعديل المهمة')

@section('content')
<div dir="rtl" class="container card bg-white p-5">
    <h1 class="card-titel">تعديل المهمة</h1>

    {{-- عرض الأخطاء إن وجدت --}}
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form class="" action="{{ route('task.update', ['listN' => $task->todo_list_id, 'task' => $task->id]) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- عنوان المهمة --}}
        <div class="mb-3">
            <label class="form-label">عنوان المهمة</label>
            <input type="text" name="titel" class="form-control" value="{{ old('titel', $task->titel) }}" required>
        </div>

        {{-- وصف المهمة --}}
        <div class="mb-3">
            <label class="form-label">الوصف</label>
            <textarea name="description" class="form-control">{{ old('description', $task->description) }}</textarea>
        </div>

        {{-- قائمة المهام --}}
        <div class="mb-3">
            <label class="form-label">القائمة</label>
            <select name="todo_list_id" class="form-select" required>
                @foreach ($todoLists as $list)
                <option value="{{ $list->id }}" {{ $task->todo_list_id == $list->id ? 'selected' : '' }}>
                    {{ $list->name }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- حالة الإنجاز --}}
        <div class="form-check form-switch" style="width: fit-content;">
            <input class="form-check-input" name="completed" type="checkbox" value="1" id="taskCompleted" {{ $task->completed ? 'checked' : '' }}>
            <label class="form-check-label" for="taskCompleted">إنجاز المهمة</label>
        </div>

        <button type="submit" class="btn btn-success mt-3">حفظ التعديلات</button>
        <a href="{{ route('tasks.index','$task->todo_list_id') }}" class="btn btn-secondary mt-3">الصفحة الرئيسية</a>
    </form>
</div>
@endsection