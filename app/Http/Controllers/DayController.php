<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDayRequest;
use App\Http\Requests\UpdateDayRequest;
use App\Models\Day;
use Illuminate\Http\Request;

class DayController extends Controller
{

    protected $route = "hari";

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.pengaturan.hari.create', [
            'route'         => $this->route
        ]);
    }


    public function store(Request $request)
    {
        $validatetData = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:days,slug',
            'date_start' => 'required',
            'date_end' => 'required'
        ]);

        Day::create($validatetData);

        return redirect('/pesanan')->with('success', 'Data berhasil ditambahkan !');
    }


    public function show(Day $day)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Day  $day
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $day = Day::find($id);
        if (!$day) {
            abort(404); // Tambahkan penanganan jika data tidak ditemukan.
        }

        return view('content.pengaturan.hari.edit', [
            'route' => $this->route,
            'data' => $day
        ]);
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'name'       => 'required',
            'slug'       => 'required|unique:days,slug,' . $id,
            'date_start' => 'required',
            'date_end'   => 'required'
        ]);
    
        $day = Day::findOrFail($id); // Temukan catatan berdasarkan ID
    
        // Update hanya bidang-bidang yang berubah
        $day->name = $request->input('name');
        $day->date_start = $request->input('date_start');
        $day->date_end = $request->input('date_end');
        
        // Simpan slug hanya jika berbeda
        if ($day->slug != $request->input('slug')) {
            $day->slug = $request->input('slug');
        }
    
        $day->save();

        return redirect('/pesanan')->with('success', 'Data berhasil diubah !');
    }

    public function destroy($id)
    {
        Day::destroy($id);
    }
}
