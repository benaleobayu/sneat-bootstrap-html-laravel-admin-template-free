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

    public function index(Request $request)
    {
        $search = $request->query('search');

        if (!empty($search)) {
            $query = pelanggan::where('name', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%')
                ->orderBy('updated_at', 'desc')->paginate(10)->withQueryString();
        } else {
            $query = pelanggan::orderBy('updated_at', 'desc')->paginate(10)->withQueryString();
        }
        return view('content.dataCenter.pelanggan.index', [
            'route'         => $this->route,
            'data'          => $query,
            'search'        => $search
        ]);
    }

    public function create()
    {
        $regencies = Regency::all();

        return view('content.dataCenter.pelanggan.create', [
            'route'         => $this->route,
            'regencies'     => $regencies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorepelangganRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepelangganRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function show(pelanggan $pelanggan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function edit(pelanggan $pelanggan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepelangganRequest  $request
     * @param  \App\Models\pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepelangganRequest $request, pelanggan $pelanggan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function destroy(pelanggan $pelanggan)
    {
        //
    }
}
