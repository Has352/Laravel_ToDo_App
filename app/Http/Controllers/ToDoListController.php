<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ToDoList;

class ToDoListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lists = ToDoList::where('user_id', Auth::id())->get();
        return view('ToDoList.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ToDoList.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        ToDoList::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('list.index')->with('success', 'تم إنشاء القائمة بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $toDoList = ToDoList::find($id);
        return view('ToDoList.show', compact('todoList'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $toDoList = ToDoList::where('id', $id && 'user_id', Auth::id())->firstOrFail();
        return view('list.edit', compact('todoList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $toDoList = ToDoList::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $toDoList->update(['name' => $request->name]);
        return redirect()->route('list.index')->with('success', 'تم التحديث بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $toDoList = ToDoList::find($id);
        $toDoList->delete();
        return redirect()->route('list.index')->with('success', 'تم الحذف بنجاح');
    }
}
