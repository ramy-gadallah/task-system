<?php

namespace App\Http\Controllers\Admin;

use App\Models\SubTask;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SubTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks=Task::get();
        $sub_tasks=SubTask::get();
        return view('admin.sub_tasks.index',compact('tasks','sub_tasks'));
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
            $validator = Validator::make($request->all(),[
                'sub_task' => 'required',
                'task_id' => 'required',          
            ],
            [
                'name.required' => 'Name is required',
                'task_id.required' => 'Task is required',
            ]);

            if($validator->fails()) {   
                return response()->json([
                    'status' => 'false',
                    'message' => $validator->errors(),
                ]);
            }
            $user = SubTask::create([
                'sub_task' => $request->sub_task,
                'description' => $request->description,
                'task_id' => $request->task_id,]);
            return response()->json([
                'status' => 'true',
                'message' => 'SubTask created successfully',
                'redirect' => route('sub.index'),
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
    public function show(SubTask $subTask)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubTask $subTask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
                // return response()->json($request->all());
        try {
            $validator = Validator::make($request->all(),[
                'sub_task' => 'required',
                'task_id' => 'required',          
            ],
            [
                'sub_task.required' => 'Name is required',
                'task_id.required' => 'Task is required',
            ]);

            if($validator->fails()) {   
                return response()->json([
                    'status' => 'false',
                    'message' => $validator->errors(),
                ]);
            }
            if($validator->fails()) {   
                return response()->json([
                    'status' => 'false',
                    'message' => $validator->errors(),
                ]);
            }

            $user = SubTask::findOrFail($request->id);
            $user->sub_task = $request->sub_task;
            $user->description = $request->description;   
            $user->task_id = $request->task_id;   
            // Update the password only if provided   
            $user->save();
            
            return response()->json([
                'status' => 'true',
                'message' => 'تم التعديل بنجاح',
                'redirect' => route('sub.index'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'false',
                'message'=>'فشل التعديل',
                'error' => $e->getMessage(),
            ]);
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $offers=SubTask::find($request->id);
        $offers->delete();
        return response()->json([
         'id'=>$request->id,
         'status'=>'200',
         'success'=>'تم الحذف بنجاح نعم',
         'unsuccess'=>'فشل الحذف',
         'redirect'=>route('sub.index'),
        ]);
    }
}
