<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLanggananRequest;
use App\Http\Requests\UpdateLanggananRequest;
use App\Models\Langganan;

class LanggananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('content.pemesanan.langganan.index',[
            'data' => Langganan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $flowers = Flower::all();
        $regencies = Regency::all();
        $days = Day::all();

        return view('create', compact('flowers', 'regencies', 'days'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'regencies_id' => 'required',
            'day_id' => 'required',
            'notes' => 'nullable',
            'flower_id' => 'required|array',
            'flower_id.*' => 'exists:flowers,id',
            'total' => 'required|array',
            'total.*' => 'integer|min:0',
        ]);

        $langganan = new Langganan;
        $langganan->name = $validatedData['name'];
        $langganan->phone = $validatedData['phone'];
        $langganan->address = $validatedData['address'];
        $langganan->regencies_id = $validatedData['regencies_id'];
        $langganan->day_id = $validatedData['day_id'];
        $langganan->notes = $validatedData['notes'];
        $langganan->save();

        $flowerData = [];
        foreach ($validatedData['flower_id'] as $index => $flowerId) {
            $flowerData[$flowerId] = ['total' => $validatedData['total'][$index]];
        }
        $langganan->flowers()->sync($flowerData);

        // Redirect or do something else
    }
    public function show(Langganan $langganan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Langganan  $langganan
     * @return \Illuminate\Http\Response
     */
    public function edit(Langganan $langganan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLanggananRequest  $request
     * @param  \App\Models\Langganan  $langganan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLanggananRequest $request, Langganan $langganan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Langganan  $langganan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Langganan $langganan)
    {
        //
    }
}
