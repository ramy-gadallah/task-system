<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use App\Models\UserTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();
        $tasks = Task::get();
        $task_users = UserTask::get();
        return view('admin.assign_tasks.index', compact('users', 'tasks', 'task_users'));
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
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'user_id' => 'required',
                    'task_id' => 'required',

                ],
                [
                    'user_id.required' => 'user_id is required',
                    'task_id.required' => 'task_id is required',
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'false',
                    'message' => $validator->errors(),
                ]);
            }


            $taskCount = UserTask::where('user_id', $request->user_id)->count();
            if ($taskCount >= 5) {
                return response()->json([
                    'status' => 'false',
                    'message' => 'User already has 5 tasks assigned',
                    'redirect' => route('assign.index'),
                ]);
            }

            $exist = UserTask::where('user_id', $request->user_id)->where('task_id', $request->task_id)->exists();
            if ($exist) {
                return response()->json([
                    'status' => 'false',
                    'message' => 'Task already assigned',
                    'redirect' => route('assign.index'),
                ]);

            }

            $user = UserTask::create([
                'user_id' => $request->user_id,
                'task_id' => $request->task_id,
            ]);
            return response()->json([
                'status' => 'true',
                'message' => 'Task assigned successfully',
                'redirect' => route('assign.index'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'false',
                'message' => $e->getMessage(),
            ]);
        }
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
    public function destroy(Request $request, string $id)
    {
        $offers = UserTask::find($request->id);
        $offers->delete();
        return response()->json([
            'id' => $request->id,
            'status' => '200',
            'success' => 'تم الحذف بنجاح نعم',
            'unsuccess' => 'فشل الحذف',
            'redirect' => route('assign.index'),
        ]);
    }
}
