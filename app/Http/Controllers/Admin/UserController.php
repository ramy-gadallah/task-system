<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=User::get();
        return view('admin.users.index',compact('users'));
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
                'email' => 'required|unique:users,email',
                'password' => 'required|confirmed',
            ],
            [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'email.unique' => 'Email already exists',
                'password.required' => 'Password is required',
                'password.confirmed' => 'confirm password does not match',
            ]);

            if($validator->fails()) {   
                return response()->json([
                    'status' => 'false',
                    'message' => $validator->errors(),
                ]);
            }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),               
            ]);
            return response()->json([
                'status' => 'true',
                'message' => 'Admin created successfully',
                'redirect' => route('users.index'),
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
        try {
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required',
                'password' => 'required|confirmed',
            ],
            [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'email.unique' => 'Email already exists',
                'password.required' => 'Password is required',
                'password.confirmed' => 'confirm password does not match',
            ]);

            if($validator->fails()) {   
                return response()->json([
                    'status' => 'false',
                    'message' => $validator->errors(),
                ]);
            }

            $user = User::findOrFail($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
 
            $user->save();
            
            return response()->json([
                'status' => 'true',
                'message' => 'تم التعديل بنجاح',
                'redirect' => route('users.index'),
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
    public function destroy(Request $request,string $id)
    {
        // return response()->json([
        //     'id'=>$request->id,
        //     'status'=>'200',
          
        // ]);
        $offers=User::find($request->id);
        $offers->delete();
        return response()->json([
         'id'=>$request->id,
         'status'=>'200',
         'success'=>'تم الحذف بنجاح نعم',
         'unsuccess'=>'فشل الحذف',
         'redirect'=>route('users.index'),
     ]);	
    }
}
