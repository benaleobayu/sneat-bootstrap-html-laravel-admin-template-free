<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role as SpatieRole;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Read.Admin']);
    }


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
            'password' => 'required|min:6'
        ]);

        $validatedData['password'] = Hash::make($request->password);

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

    public function edit($id)
    {
        $user = User::find($id);
        $role = Role::all();

        return view('content.pengaturan.admin.edit', compact('role', 'user'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
        'name'          => 'required',
        'username'      => 'required|unique:users,username',
        'email'         => 'required|unique:users,username',
        'role'          => 'required',
        'password'      => 'nullable|min:6' 
        ]);
            

        $user = User::find($id);
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        
        if($request->has('password')){
            $validatedData['password'] = bcrypt($request->password);
        }
        
        $roles = $request->input('role', []);
        $user->syncRoles($roles);
        
        $user->save();

        return redirect('/admin')->with('success', 'Admin berhasil diubah.');

    }

    public function destroy($id)
    {
        User::destroy($id);
    }
}
