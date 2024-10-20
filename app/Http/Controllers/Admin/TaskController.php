<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks=Task::get();
        return view('admin.tasks.index',compact('tasks'));
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
                'name' => 'required',      
            ],
            [
                'name.required' => 'Name statusis required',             
            ]);

            if($validator->fails()) {   
                return response()->json([
                    'status' => 'false',
                    'message' => $validator->errors(),
                ]);
            }
            $user = Task::create([
                'name' => $request->name,
              
            ]);
            return response()->json([
                'status' => 'true',
                'message' => 'Task created successfully',
                'redirect' => route('tasks.index'),
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
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(),[
                'name' => 'required',
            ],
            [
                'name.required' => 'Name is required',
            ]);

            if($validator->fails()) {   
                return response()->json([
                    'status' => 'false',
                    'message' => $validator->errors(),
                ]);
            }
            $user = Task::findOrFail($request->id);
            $user->name = $request->name;       
            // Update the password only if provided   
            $user->save();
            
            return response()->json([
                'status' => 'true',
                'message' => 'تم التعديل بنجاح',
                'redirect' => route('tasks.index'),
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
        $offers=Task::find($request->id);
        $offers->delete();
        return response()->json([
         'id'=>$request->id,
         'status'=>'200',
         'success'=>'تم الحذف بنجاح نعم',
         'unsuccess'=>'فشل الحذف',
         'redirect'=>route('tasks.index'),
        ]);
    }
}
