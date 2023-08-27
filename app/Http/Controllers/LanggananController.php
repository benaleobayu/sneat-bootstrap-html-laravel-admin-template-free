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
        $search = $request->query('search');

        if (!empty($search)) {
            $query = Langganan::where('name', 'like', '%' . $search . '%')
                                ->orWhere('hari', 'like', '%' . $search . '%')
                ->orderBy('updated_at', 'desc')->paginate(10)->withQueryString();
        } else {
            $query = Langganan::orderBy('updated_at', 'desc')->paginate(10)->withQueryString();
        }
        return view('content.dataCenter.langganan.index', [
            'route' => $this->route,
            'data' => $query,
            'search' => $search,
            'viewSearch' => "index"
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
        $langganan->pic = auth()->user()->name;
        $langganan->save();

        $flowerData = [];
        foreach ($validatedData['flower_id'] as $index => $flowerId) {
            $flowerData[$flowerId] = ['total' => $validatedData['total'][$index]];
        }
        $langganan->flowers()->sync($flowerData);

        // Redirect or do something else
        return redirect('/langganan')->with('success', 'Data Langganan berhasil ditambahkan !');
    }
    public function show($id)
    {
        $data = Langganan::find($id);
        $name = $data->name;
        $flowers = Flower::all();
        $regencies = Regency::all();
        $days = Day::all();

        return view('content.dataCenter.langganan.show', compact('data', 'name', 'flowers', 'regencies', 'days'));
    }

    public function edit($id)
    {
        $data = Langganan::find($id);
        $name = $data->name;
        $flowers = Flower::all();
        $regencies = Regency::all();
        $days = Day::all();

        return view('content.dataCenter.langganan.edit', compact('data', 'name', 'flowers', 'regencies', 'days'));
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
        ]);

        $langganan->name = $request->name;
        $langganan->phone = $request->phone;
        $langganan->address = $request->address;
        $langganan->regencies_id = $request->regencies_id;
        $langganan->day_id = $request->day_id;
        $langganan->notes = $request->notes;
        $langganan->pic = auth()->user()->name;

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
            'pic' => $langganan->pic,
            // Tambahkan kolom-kolom lain sesuai kebutuhan Anda
        ]);
    }

    // Opsional: Anda dapat menambahkan pesan keberhasilan atau mengembalikan respons
    return redirect()->route('pesanan.index')->with('success', 'Data berhasil diimpor.');
}
}