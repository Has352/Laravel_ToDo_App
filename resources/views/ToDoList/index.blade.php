@extends('layouts.app')

@section('title', 'قوائم المهام')

@section('content')
<section class="mt-0 container col-12 ">
    <div class=" card bg-white pt-3 " style="padding: 3% 15%;" dir="rtl">
        <h1 class="mb-4">القوائم</h1>
        <div>
            <a class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal">
                إضافة قائمة جديدة
            </a>
        </div>
        <div class="row match-height  d-flex justify-content-evenly">
            @foreach ($lists as $list)
            <div class="col-xl-3 col-lg-12 card card-body mx-3" style="border: 0.1rem #e3e3e3 solid;">
                <div class="">
                    <div class="">
                        <div class="">
                            <h4 class="">
                                <span>{{ $list->name }}</span>
                                <span class="float-right cursor-pointer">
                                    <i class="ft-more-vertical-"></i>
                                </span>
                                <span>
                                    <a class=" float-right cursor-pointer" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                            <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="btn dropdown-item" data-toggle="modal" data-target="#editModal{{ $list->id }}">
                                            تعديل
                                        </a>
                                        <a class="btn dropdown-item" data-toggle="modal" data-target="#deleteModal{{ $list->id }}">
                                            حذف
                                        </a>
                                    </div>
                                </span>
                            </h4>
                            <p class="grey">{{ $list->created_at }}</p>
                            <ul class="list-group mb-3">
                                <li class="list-group-item">
                                    <span>عدد المهام</span>
                                    <span class="badge bg-light-info float-right">{{ $list->tasks->count() }}</span>
                                </li>
                                <li class="list-group-item">
                                    <span>المهام المكتملة</span>
                                    <span class="badge bg-light-primary float-right">{{ $list->tasks->where('completed',1)->count() }}</span>
                                </li>
                                <li class="list-group-item">
                                    <span>المهام غير المكتملة</span>
                                    <span class="badge bg-light-warning float-right">{{ $list->tasks->where('completed',0)->count() }}</span>
                                </li>
                            </ul>
                            <a href="{{ route('tasks.index', $list->id) }}" class=" btn btn-primary mr-2">التفاصيل</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- delete Modal -->
            <div class="modal fade" id="deleteModal{{ $list->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h5 class="modal-title" id="exampleModalLabel">حذف {{ $list->name }}!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            هل انت متأكد من حذف {{ $list->name }} ؟
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">تراجع</button>
                            <form action="{{ route('list.destroy', [$list->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">حذف</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End delete Modal -->
            <!-- edit Modal -->
            <div class="modal fade" id="editModal{{ $list->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-warning">
                            <h5 class="modal-title" id="exampleModalLabel">تعديل {{ $list->name }}!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('list.update', $list->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">اسم القائمة</label>
                                    <input type="text" name="name" class="form-control" value="{{ $list->name }}" required>
                                </div>
                                <button type="submit" class="btn btn-success">حفظ التعديلات</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End edit Modal -->
            @endforeach
        </div>
    </div>
</section>



<!-- edit Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel">اضافة قائمة جديدة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('list.store', $list->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">اسم القائمة</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">اضافة</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End edit Modal -->
@endsection