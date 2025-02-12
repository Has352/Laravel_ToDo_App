@extends('layouts.app')

@section('title', 'إضافة قائمة جديدة')

@section('content')
<div class="container">
    <h1>إضافة قائمة جديدة</h1>
    <form action="{{ route('list.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">اسم القائمة</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <button type="submit" class="btn btn-success">حفظ</button>
        <a href="{{ route('list.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
</div>
@endsection