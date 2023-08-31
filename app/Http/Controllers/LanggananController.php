<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Flower;
use App\Models\Langganan;
use App\Models\pesanan;
use App\Models\Regency;
use Illuminate\Http\Request;

class LanggananController extends Controller
{
    protected $route = 'langganan';

    public function __construct()
    {
        $this->middleware(['permission:Read.Langganan']);
    }

    public function index(Request $request)
    {
        $query = Day::whereBetween('id', [1,7])
                            ->orderBy('id', 'asc')->paginate(10)->withQueryString();
       
        return view('content.dataCenter.langganan.index', [
            'route' => $this->route,
            'data' => $query,
            'search' => '',
            'viewSearch' => "index"
        ]);
    }

    public function create()
    {
        $flowers = Flower::all();
        $regencies = Regency::all();
        $days = Day::whereBetween('id', [1,7])->get();

        return view('content.dataCenter.langganan.create', compact('flowers', 'regencies', 'days'),[
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
            'range' => 'nullable',
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
        $langganan->range = $validatedData['range'];
        $langganan->save();

        $flowerData = [];
        foreach ($validatedData['flower_id'] as $index => $flowerId) {
            $flowerData[$flowerId] = ['total' => $validatedData['total'][$index]];
        }
        $langganan->flowers()->sync($flowerData);

        // Redirect or do something else
        return redirect('/langganan')->with('success', 'Data Langganan berhasil ditambahkan !');
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

        return view('content.dataCenter.langganan.show_langganan', [
            'route' => $this->route,
            'data' => $query,
            'search' => $search,
            'slug' => $slug
        ]);
    }

    public function edit($id)
    {
        $data = Langganan::find($id);
        $name = $data->name;
        $flowers = Flower::all();
        $regencies = Regency::all();
        $days = Day::whereBetween('id', [1,7])->get();

        return view('content.dataCenter.langganan.edit', compact('data', 'name', 'flowers', 'regencies', 'days'),[
            'route' => $this->route
        ]);
    }

    public function update(Request $request, $id)
    {
        $langganan = Langganan::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'regencies_id' => 'required',
            'day_id' => 'required',
            'notes' => 'nullable',
            'range' => 'nullable',
            'route' => 'nullable',
        ]);

        $langganan->name = $request->name;
        $langganan->phone = $request->phone;
        $langganan->address = $request->address;
        $langganan->regencies_id = $request->regencies_id;
        $langganan->day_id = $request->day_id;
        $langganan->notes = $request->notes;
        $langganan->range = $request->range;
        $langganan->route = $request->route;

        $flowersData = [];
        for ($i = 0; $i < count($request->flower_id); $i++) {
            $flowersData[$request->flower_id[$i]] = ['total' => $request->total[$i]];
        }
        $langganan->flowers()->sync($flowersData);

        $langganan->save();

        // Redirect or do something else
        return redirect('/langganan')->with('success', 'Data Langganan berhasil diubah !');
    }

    public function destroy($id)
    {
        Langganan::destroy($id);

        // return redirect('/langganan')->with('success', 'Data Langganan berhasil dihapus !');
    }

    public function importDataByDay(Request $request)
{
    // Mendapatkan hari yang dipilih oleh pengguna dari permintaan
    $hari = $request->input('hari');

    // Mendapatkan data langganan berdasarkan hari yang dipilih
    $langgananRecords = Langganan::where('hari', $hari)->get();

    // Melakukan loop pada data yang diambil dan membuat catatan pesanan
    foreach ($langgananRecords as $langganan) {
        pesanan::create([
            'name' => $langganan->name,
            'address' => $langganan->address,
            'phone' => $langganan->phone,
            'notes' => $langganan->notes,
            // Tambahkan kolom-kolom lain sesuai kebutuhan Anda
        ]);
    }

    // Opsional: Anda dapat menambahkan pesan keberhasilan atau mengembalikan respons
    return redirect()->route('pesanan.index')->with('success', 'Data berhasil diimpor.');
}
}