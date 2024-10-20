<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  
    public function index()
    {
        $admins=Admin::get();
        return view('admin.admins.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admins.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator= validator($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ],[
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email is not valid',
            'email.unique' => 'Email already exists',
            'password.required' => 'Password is required',
            'password.confirmed' => 'Password confirmation does not match'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
         }
      else{
        
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        session()->flash('success', 'تم الاضافة بنجاح'); 

        return redirect()->route('admins.index');
    }
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
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
    public function update(Request $request)
    {
        $validator=validator($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'confirmed'
        ],[
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email is not valid',
            'email.unique' => 'Email already exists',
            'password.required' => 'Password is required',
            'password.confirmed' => 'Password confirmation does not match'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
            Admin::find($request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            session()->flash('success', 'تم التعديل بنجاح'); 
            return redirect()->route('admins.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Admin::find($request->id)->delete();
        session()->flash('success', 'تم الحذف بنجاح'); 
        return redirect()->route('admins.index');
    }
}
