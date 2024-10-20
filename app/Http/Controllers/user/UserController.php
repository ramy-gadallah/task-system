<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\SubTask;
use App\Models\UserTask;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id=auth()->user()->id;
        $user_tasks=UserTask::where('user_id',$user_id)->get();

        // $sub_tasks=SubTask::whereIn('id',$user_tasks->pluck(value: ))->get();
        return view('admin.user_tasks.index',compact('user_tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
