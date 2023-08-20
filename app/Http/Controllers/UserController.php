<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role as SpatieRole;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, SpatieRole $SpatieRole)
    {

        $search = $request->query('search');

        if (!empty($search)) {
            $query = User::where('name', 'like', '%' . $search . '%')
                ->orderBy('updated_at', 'desc')->paginate(10)->withQueryString();
        } else {
            $query = User::orderBy('updated_at', 'desc')->paginate(10)->withQueryString();
        }
        return view('content.pengaturan.admin.index', [
            'route' => 'admin',
            'data' => $query,
            'search' => $search
        ]);
    }

    public function create()
    {
        $role = Role::all();
        return view('content.pengaturan.admin.create', compact('role'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3|max:16'
        ]);


        // if (User::where('username', $request->username)->exists() || User::where('email', $request->email)->exists()) {
        //     return response()->json(['error' => 'Username atau email sudah ada dalam database'], 422);
        // }

        $roles = $request->role;

        
        $existingUser = User::where('username', $validatedData['username'])
        ->orWhere('email', $validatedData['email'])
        ->first();
        
        if ($existingUser) {
            $errorMessage = '';
            if ($existingUser->username === $validatedData['username']) {
                $errorMessage = 'Username sudah ada dalam database.';
            } elseif ($existingUser->email === $validatedData['email']) {
                $errorMessage = 'Email sudah ada dalam database.';
            }
            
            return response()->json(['error' => $errorMessage], 422);
        }
        
        $save = User::create($validatedData);
        // Jika validasi berhasil, simpan data admin ke database
        // ...
        $save->assignRole($roles);

        return response()->json(['success' => 'Admin berhasil ditambahkan.'], 200);
    }

    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $role = Role::all();

        return view('content.pengaturan.admin.edit', compact('role', 'user'));
    }


    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
    }
}
