<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorepesananRequest;
use App\Http\Requests\UpdatepesananRequest;
use App\Models\Day;
use App\Models\Flower;
use App\Models\pesanan;
use App\Models\Regency;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    protected $route = 'pesanan';

    public function __construct()
    {
        $this->middleware(['permission:Read.Pesanan']);
    }

    public function index(Request $request)
    {
        $search = $request->query('search');

        if (!empty($search)) {
            $query = Day::whereNotBetween('id', [1, 7])
                ->where(function ($q) use ($search){
                    $q->where('name', 'like', '%' . $search . '%');
                }) 
                ->orderBy('updated_at', 'desc')->paginate(10)->withQueryString();
        } else {
            $query = Day::whereNotBetween('id', [1, 7])
            ->orderBy('updated_at', 'desc')->paginate(10)->withQueryString();
        }
        return view('content.pemesanan.pesanan.index', [
            'route' => $this->route,
            'data' => $query,
            'search' => $search
        ]);
    }

    public function create()
    {
        $flowers = Flower::all();
        $regencies = Regency::all();
        $days = Day::all();

        return view('content.pemesanan.pesanan.create', compact('flowers', 'regencies', 'days'),[
            'route' => $this->route
        ]);
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

        $langganan = new pesanan();
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
        return redirect('/pesanan')->with('success', 'Data Langganan berhasil ditambahkan !');
    }
    public function show(Request $request, $slug)
{
    $search = $request->query('search');

    $query = Day::where('slug', $slug)->firstOrFail()->pesanan();

    if (!empty($search)) {
        $query->where('name', 'like', '%' . $search . '%');
    }

    $query = $query->orderBy('updated_at', 'desc')
        ->paginate(10)
        ->withQueryString();

    return view('content.pemesanan.pesanan.show_order', [
        'route' => $this->route,
        'data' => $query,
        'search' => $search,
        'slug' => $slug
    ]);
}


    public function edit($id)
    {
        $data = pesanan::find($id);
        $name = $data->name;
        $flowers = Flower::all();
        $regencies = Regency::all();
        $days = Day::all();

        return view('content.pemesanan.pesanan.edit', compact('data', 'name', 'flowers', 'regencies', 'days'),[
            'route' => $this->route
        ]);
    }

    public function update(Request $request, $id)
    {
        $langganan = pesanan::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'regencies_id' => 'required',
            'day_id' => 'required',
        ]);

        $langganan->name = $request->name;
        $langganan->phone = $request->phone;
        $langganan->address = $request->address;
        $langganan->regencies_id = $request->regencies_id;
        $langganan->day_id = $request->day_id;
        $langganan->notes = $request->notes;

        $flowersData = [];
        for ($i = 0; $i < count($request->flower_id); $i++) {
            $flowersData[$request->flower_id[$i]] = ['total' => $request->total[$i]];
        }
        $langganan->flowers()->sync($flowersData);

        $langganan->save();

        // Redirect or do something else
        return redirect('/pesanan')->with('success', 'Data Langganan berhasil diubah !');
    }

    public function destroy($id)
    {
        pesanan::destroy($id);

        // return redirect('/pesanan')->with('success', 'Data Langganan berhasil dihapus !');
    }
}