<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\ToDoList;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\error;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $todoList = ToDoList::with([
            'tasks' => function ($query) use ($id) {
                $query->where('todo_list_id', $id);
            }
        ])->findOrFail($id);
        $todoLists = ToDoList::where('user_id', Auth::id())->get(); // جلب جميع القوائم الخاصة بالمستخدم

        return view('task.index', compact('todoList', 'todoLists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($todoListId)
    {
        return view('task.create', compact('todoListId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $todoListId)
    {

        $request->validate([
            'titel' => 'required|string|max:255',
        ]);

        $task = Task::create([
            'todo_list_id' => $todoListId,
            'titel' => $request->titel,
            'description' => $request->description,
            'completed' => false,
        ]);
        return redirect()->route('tasks.index', $todoListId)->with('success', 'تم الاضافة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::find($id);
        return view('task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, string $todoListId)
    {
        $task = Task::findOrFail($id);
        $todoLists = ToDoList::where('user_id', Auth::id())->get(); // جلب جميع القوائم الخاصة بالمستخدم

        return view('task.edit', compact('task', 'todoLists'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $listN, $id)
    {
        $request->validate([
            'titel' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task = Task::where('id', $id)->firstOrFail();

        $task->update([
            'titel' => $request->titel,
            'description' => $request->description,
            'completed' => $request->has('completed') ? 1 : 0,
            'todo_list_id' => $request->todo_list_id
        ]);

        return redirect()->route('tasks.index', ['listN' => $listN])
            ->with('success', 'تم تحديث المهمة بنجاح!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($listId, $taskId)
    {
        $task = Task::where('id', $taskId)->firstOrFail();
        $task->delete();
        return redirect()->route('tasks.index', ['listN' => $listId])->with('success', 'تم الحذف بنجاح');
    }
}
