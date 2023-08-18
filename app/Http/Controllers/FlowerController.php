<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateFlowerRequest;
use App\Models\Flower;
use Illuminate\Http\Request;

class FlowerController extends Controller
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
            $query = Flower::where('name', 'like', '%' . $search . '%')
                ->orderBy('updated_at', 'desc')->paginate(10)->withQueryString();
        } else {
            $query = Flower::orderBy('updated_at', 'desc')->paginate(10)->withQueryString();
        }
        return view('content.pengaturan.flower.index', [
            'route' => 'Bunga',
            'data' => $query,
            'search' => $search
        ]);
    }

    public function create()
    {
        return view('content.pengaturan.flower.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required',
            'name' => 'required',
            'price' => 'required'
        ]);

        Flower::create($validatedData);

        return redirect('/bunga')->with('success', 'Data Bunga berhasil ditambahkan !');
    }

    public function edit(Flower $flower, $id)
    {
        $data = Flower::find($id);
        $code = $data->code;
        $name = $data->name;
        $price = $data->price;

        return view('content.pengaturan.flower.edit', compact('data', 'code', 'name', 'price'));
    }

    public function update(Request $request, $id)
    {
        $flower = Flower::findOrFail($id);

        $validatedData = $request->validate([
            'code' => 'required',
            'name' => 'required',
            'price' => 'required'
        ]);

        $flower->update($validatedData);

        return redirect('/bunga')->with('success', 'Data Bunga berhasil diubah !');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Flower  $flower
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Flower::destroy($id);

        return redirect('/bunga')->with('success', 'Data berhasil dihapus !');
    }
}
