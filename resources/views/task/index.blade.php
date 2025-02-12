@extends('layouts.app')

@section('title', 'المهام')

@section('content')
<div class="container" dir="rtl">
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-12">
            <div class="card bg-info bg-lighten-3">
                <div class="card-content">
                    <div class="card-body py-0">
                        <div class="media">
                            <div class="media-body info text-left">
                                <h3 class="font-large-1 info mb-0">{{ $todoList->tasks->count() }}</h3>
                                <span>عدد المهام</span>
                            </div>
                            <div class="media-right info text-right">
                                <i class="ft-percent font-large-1"></i>
                            </div>
                        </div>
                    </div>
                    <div id="Widget-line-chart" class="height-75 WidgetlineChart WidgetlineChartShadow WidgetChart1 mb-3"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-12">
            <div class="card bg-success bg-lighten-3">
                <div class="card-content">
                    <div class="card-body py-0">
                        <div class="media">
                            <div class="media-body success text-left">
                                <h3 class="font-large-1 success mb-0">{{ $todoList->tasks->where('completed',1)->count() }}</h3>
                                <span>المهام المكتملة</span>
                            </div>
                            <div class="media-right success text-right">
                                <i class="ft-credit-card font-large-1"></i>
                            </div>
                        </div>
                    </div>
                    <div id="Widget-line-chart4" class="height-75 WidgetlineChart WidgetlineChartShadow WidgetChart4 mb-3"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-12">
            <div class="card bg-warning bg-lighten-3">
                <div class="card-content">
                    <div class="card-body py-0">
                        <div class="media">
                            <div class="media-body warning text-left">
                                <h3 class="font-large-1 warning mb-0">{{ $todoList->tasks->where('completed',0)->count() }}</h3>
                                <span>المهام غير المكتملة</span>
                            </div>
                            <div class="media-right warning text-right">
                                <i class="ft-activity font-large-1"></i>
                            </div>
                        </div>
                    </div>
                    <div id="Widget-line-chart2" class="height-75 WidgetlineChart WidgetlineChartShadow WidgetChart2 mb-3"></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-12">
            <div class="card bg-primary bg-lighten-3">
                <div class="card-content">
                    <div class="card-body py-0">
                        <div class="media">
                            <div class="media-body primary text-left">
                                <h3 class="font-large-1 primary mb-0">{{number_format($todoList->tasks->count() > 0 ? ($todoList->tasks->where('completed',1)->count() / $todoList->tasks->count()) * 100 : 0)}}%</h3>
                                <span>نسبة انجاز المهام</span>
                            </div>
                            <div class="media-right primary text-right">
                                <i class="ft-trending-up font-large-1"></i>
                            </div>
                        </div>
                    </div>
                    <div id="Widget-line-chart3" class="height-75 WidgetlineChart WidgetlineChartShadow WidgetChart3 mb-3"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row grouping -->
    <section id="row-grouping">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>قائمة: {{ $todoList->name }}</h4>
                    </div>
                    <div class="card-content ">
                        <div class="card-body">
                            <a class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal">
                                إضافة مهمة جديدة
                            </a>
                            <a href="{{ route('list.index') }}" class="btn btn-secondary mb-3"><i class="bi bi-house"></i> الرئيسية</a>
                            <div class="table-responsive">
                                <table class="table table-bordered row-grouping text-center">
                                    <thead>
                                        <tr>
                                            <th>العنوان</th>
                                            <th>الوصف</th>
                                            <th>الانجاز</th>
                                            <th>زر التعديل</th>
                                            <th>زر الحذف</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($todoList->tasks as $task)
                                        <tr>
                                            <td>{{ $task->titel }}</td>
                                            <td>{{ $task->description }}</td>
                                            <td><span class="{{ $task->completed? "badge badge-success" : "badge badge-warning" }}">{{ $task->completed? 'تم' : 'قيد التنفيذ' }}</span></td>
                                            <td> <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal{{ $task->id }}">
                                                    تعديل
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $task->id }}">
                                                    حذف
                                                </button>
                                            </td>
                                        </tr>


                                        <!-- delete Modal -->
                                        <div class="modal fade" id="deleteModal{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger">
                                                        <h5 class="modal-title" id="exampleModalLabel">حذف {{ $task->titel }}!</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        هل انت متأكد من حذف {{ $task->titel }} ؟
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">تراجع</button>
                                                        <form action="{{ route('task.destroy', [$todoList->id, $task->id]) }}" method="POST" style="display:inline;">
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
                                        <div class="modal fade" id="editModal{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning">
                                                        <h5 class="modal-title" id="exampleModalLabel">حذف {{ $task->titel }}!</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
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
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" name="completed" type="checkbox" value="1" id="taskCompleted" {{ $task->completed ? 'checked' : '' }}>
                                                                <label class="form-check-label ml-3" for="taskCompleted">إنجاز المهمة</label>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-warning">تحديث</button>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">تراجع</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End edit Modal -->
                            </div>


                            @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
<!-- Row grouping -->


<!-- edit Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel">اضافة مهمة جديدة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" action="{{ route('task.store', ['listN' => $task->todo_list_id, 'task' => $task->id]) }}" method="POST">
                    @csrf
                    {{-- عنوان المهمة --}}
                    <div class="mb-3">
                        <label class="form-label">عنوان المهمة</label>
                        <input type="text" name="titel" class="form-control" required>
                    </div>

                    {{-- وصف المهمة --}}
                    <div class="mb-3">
                        <label class="form-label">الوصف</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">اضافة</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">تراجع</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End edit Modal -->
@endsection