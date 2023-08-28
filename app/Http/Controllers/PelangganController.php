<?php

namespace App\Http\Controllers;

use App\Models\pelanggan;
use App\Http\Requests\StorepelangganRequest;
use App\Http\Requests\UpdatepelangganRequest;
use App\Models\Regency;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    
    protected $route = 'pelanggan';

    public function __construct()
    {
        $this->middleware(['permission:Read.Pelanggan']);
    }

    public function index(Request $request)
    {
        $search = $request->query('search');

        if (!empty($search)) {
            $query = pelanggan::where('type', 'p')
            ->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('address', 'like', '%' . $search . '%');
            })
            ->orderBy('updated_at', 'desc')->paginate(10)->withQueryString();
        } else {
        $query = pelanggan::where('type', 'p')
            ->orderBy('updated_at', 'desc')->paginate(10)->withQueryString();
        }
        return view('content.dataCenter.pelanggan.index', [
            'route'         => $this->route,
            'data'          => $query,
            'search'        => $search
        ]);
    }

    public function create()
    {
        $regencies = Regency::orderBy('name', 'asc')->get();

        return view('content.dataCenter.pelanggan.create', [
            'route'         => $this->route,
            'regencies'     => $regencies
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'phone' => 'max:15',
            'address' => 'required',
            'regencies_id' => 'required',
            'range' => 'required'
        ]);
        $validatedData['notes'] = $request->notes;
        $validatedData['type'] = 'p';

        pelanggan::create($validatedData);

        return redirect('/pelanggan')->with('success', 'Data berhasil ditambahkan!');
    }

    public function show($id)
    {
        $data = pelanggan::find($id);

        return view('content.dataCenter.pelanggan.show', [
            'route'         => $this->route,
            'data'     => $data
        ]);
    }

    public function edit($id)
    {

        $data = pelanggan::find($id);

        $regencies = Regency::orderBy('name', 'asc')->get();

        return view('content.dataCenter.pelanggan.edit', [
            'route'             => $this->route,
            'data'              => $data,
            'regencies'         => $regencies
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name'              => 'required',
            'phone'             => 'max:15',
            'address'           => 'required',
            'regencies_id'      => 'required',
            'range'             => 'required'
        ]);
        $validatedData['notes'] = $request->notes;
        $validatedData['type'] = 'p';

        pelanggan::where('id', $id)->update($validatedData);

        return redirect('/pelanggan')->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        pelanggan::destroy($id);

        // return redirect('/pelanggan')->with('success', 'Data berhasil dihapus!');
    }
}
