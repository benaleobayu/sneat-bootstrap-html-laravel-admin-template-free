<?php

namespace App\Http\Controllers;

use App\Models\myprofile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MyprofileController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        return view('content.myprofile.index',[
            'user' => $user
        ]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('content.myprofile.edit',[
            'route' => "myprofile",
            'user' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
   

        $validatedData = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'nullable|min:6'
        ]);

        $user = User::where('id', $id)->update($validatedData);

        
        if ($request->filled('password')){
            $user->password = Hash::make($request->password);
        }

        Return redirect('/myprofile')->with('success', 'Data berhasil diubah');
    }

}

