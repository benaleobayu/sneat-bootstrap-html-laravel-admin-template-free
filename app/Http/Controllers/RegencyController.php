<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRegencyRequest;
use App\Models\Regency;
use Illuminate\Http\Request;

class RegencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        if (!empty($search)) {
            $query = Regency::where('name', 'like', '%' . $search . '%')
                ->orderBy('updated_at', 'desc')->paginate(10)->withQueryString();
        } else {
            $query = Regency::orderBy('updated_at', 'desc')->paginate(10)->withQueryString();
        }
        return view('content.pengaturan.regency.index', [
            'route' => 'daerah',
            'data' => $query,
            'search' => $search
        ]);
    }

    public function create()
    {
        return view('content.pengaturan.regency.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'city' => 'required'
        ]);

        Regency::create($validatedData);

        return redirect('/daerah')->with('Success', 'Data telah ditambahkan !');
    }

    public function edit($id)
    {
        $data = Regency::find($id);
        $name = $data->name;
        $city = $data->city;

        return view('content.pengaturan.regency.edit', compact('data','name','city'));
        
    }

 
    public function update(Request $request, $id)
    {
        $regency = Regency::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required',
            'city' => 'required'
        ]);

        $regency->update($validatedData);

        return redirect('/daerah')->with('Success', 'Data telah diubah !');
    }

    
    public function destroy($id)
    {
        Regency::destroy($id);

    }
}
