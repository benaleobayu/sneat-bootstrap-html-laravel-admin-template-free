<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->query('search');

        if (!empty($search)) {
            $query = Role::where('name', 'like', '%' . $search . '%')
                ->orderBy('updated_at', 'desc')->paginate(10)->withQueryString();
        } else {
            $query = Role::orderBy('updated_at', 'desc')->paginate(10)->withQueryString();
        }
        return view('content.pengaturan.role.index', [
            'route' => 'roles',
            'data' => $query,
            'search' => $search
        ]);
    }

    public function create()
    {
        $permissions = Permission::all();
        $pname = $permissions->first()->name;
        $parts = explode('.', $pname);

        $beforeDot = $parts[0]; // Bagian sebelum titik
        if (isset($parts[1])) {
            $afterDot = $parts[1];
        } else {
            // Handle the case where there is no element at index 1
            $afterDot = ''; // or some default value
        }
        return view('content.pengaturan.role.create', compact('permissions', 'beforeDot', 'afterDot'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:roles',
            'permissions' => 'required|array'
        ]);
        $validatedData['guard_name'] = 'web';
        $role = Role::create($validatedData);

        $role->syncPermissions($validatedData['permissions']);



        return redirect('/roles')->with('success', 'Role created successfully');
    }


    public function show(Role $role)
    {
        $permissions = Permission::all();
        return view('content.pengaturan.role.show', compact('role', 'permissions'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('content.pengaturan.role.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'array'
        ]);

        $role->update(['name' => $validatedData['name']]);

        $role->syncPermissions($validatedData['permissions']);

        return redirect('/roles')->with('success', 'Role updated successfully');
    }

    public function destroy($id)
    {
        Role::destroy($id);

        return redirect('/roles')->with('success', 'Data berhasil dihapus !');
    }
}
