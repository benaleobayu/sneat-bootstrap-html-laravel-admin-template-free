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
                ->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                })
                ->orderBy('date_end', 'desc')->paginate(10)->withQueryString();
        } else {
            $query = Day::whereNotBetween('id', [1, 7])
                ->orderBy('date_end', 'desc')->paginate(10)->withQueryString();
        }
        return view('content.pemesanan.pesanan.index', [
            'route' => $this->route,
            'data' => $query,
            'search' => $search,
        ]);
    }

    public function create()
    {
        $flowers = Flower::where('additional', 'false')->get();
        $additional = Flower::where('additional', 'true')->get();
        $regencies = Regency::all();
        $days = Day::whereNotBetween('id', [1, 7])->orderBy('date_end', 'desc')->get();

        return view('content.pemesanan.pesanan.create', compact('flowers', 'regencies', 'days', 'additional'), [
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
            'rider' => 'nullable',
            'route' => 'nullable',
            'additional' => 'array',
            'additional.*' => 'exists:flowers,id', // Validasi tambahan harus sesuai dengan tabel flowers
            'flower_id' => 'required|array',
            'flower_id.*' => 'exists:flowers,id', // Validasi bunga juga harus sesuai dengan tabel flowers
            'total' => 'required|array',
            'total.*' => 'integer|min:0',
        ]);
    
        $langganan = new Pesanan(); // Pastikan nama model "Pesanan" sudah benar
        $langganan->name = $validatedData['name'];
        $langganan->phone = $validatedData['phone'];
        $langganan->address = $validatedData['address'];
        $langganan->regencies_id = $validatedData['regencies_id'];
        $langganan->day_id = $validatedData['day_id'];
        $langganan->notes = $validatedData['notes'];
        $langganan->range = $validatedData['range'];
        $langganan->rider = $validatedData['rider'];
        $langganan->route = $validatedData['route'];
        $langganan->save();
    
        $flowerData = [];
    
        // Loop melalui data bunga yang diposting
        foreach ($validatedData['flower_id'] as $index => $flowerId) {
            $flowerData[$flowerId] = [
                'total' => $validatedData['total'][$index],
            ];
    
            // Jika ada bunga tambahan, tambahkan juga ke dalam data
            if (isset($validatedData['additional'][$index])) {
                $flowerData[$flowerId]['additional_flower_id'] = $validatedData['additional'][$index];
            }
        }
    
        // Synchronize data bunga ke dalam relasi
        $langganan->flowers()->sync($flowerData);
    
        // Redirect atau lakukan tindakan lainnya
        return redirect('/pesanan')->with('success', 'Data Langganan berhasil ditambahkan !');
    }
    
    public function show(Request $request, $id)
    {
        $data = pesanan::find($id);
        $name = $data->name;
        $flowers = Flower::where('additional', 'false')->get();
        $additional = Flower::where('additional', 'true')->get();
        $regencies = Regency::all();
        $days = Day::whereNotBetween('id', [1,7])->get();

        return view('content.pemesanan.pesanan.show', compact('data', 'name', 'flowers', 'additional', 'regencies', 'days'), [
            'route' => $this->route
        ]);
    }


    public function edit($id)
    {
        $data = pesanan::find($id);
        $name = $data->name;
        $flowers = Flower::where('additional', 'false')->get();
        $additional = Flower::where('additional', 'true')->get();
        $regencies = Regency::all();
        $days = Day::whereNotBetween('id', [1,7])->get();

        return view('content.pemesanan.pesanan.edit', compact('data', 'name', 'flowers', 'additional', 'regencies', 'days'), [
            'route' => $this->route
        ]);
    }

    public function update(Request $request, $id)
{
    // Validasi input
    $validatedData = $request->validate([
        'name' => 'required',
        'phone' => 'required',
        'address' => 'required',
        'regencies_id' => 'required',
        'day_id' => 'required',
        'notes' => 'nullable',
        'range' => 'nullable',
        'rider' => 'nullable',
        'route' => 'nullable',
        'additional' => 'array',
        'additional.*' => 'exists:flowers,id', // Validasi tambahan harus sesuai dengan tabel flowers
        'flower_id' => 'required|array',
        'flower_id.*' => 'exists:flowers,id', // Validasi bunga juga harus sesuai dengan tabel flowers
        'total' => 'required|array',
        'total.*' => 'integer|min:0',
    ]);

    $langganan = Pesanan::findOrFail($id);

    $langganan->fill($validatedData);

    $langganan->save();

    $flowerData = [];

    foreach ($validatedData['flower_id'] as $index => $flowerId) {
        $flowerData[$flowerId] = ['total' => $validatedData['total'][$index],
        ];

        // Periksa apakah atribut 'additional' ada dalam permintaan dan apakah ada nilai di indeks ini
        if (isset($validatedData['additional']) && isset($validatedData['additional'][$index])) {
            $flowerData[$flowerId]['additional_flower_id'] = $validatedData['additional'][$index];
        } else {
            $flowerData[$flowerId]['additional_flower_id'] = []; // Tetapkan nilai kosong jika tidak ada dalam permintaan
        }
    }

    $langganan->flowers()->sync($flowerData);

    return redirect('/pesanan')->with('success', 'Data Langganan berhasil diperbarui!');
}

    public function destroy($id)
    {
        pesanan::destroy($id);

        // return redirect('/pesanan')->with('success', 'Data Langganan berhasil dihapus !');
    }

    public function invoice(Request $request, $slug)
    {
        $search = $request->query('search');

        $query = Day::where('slug', $slug)->firstOrFail()->pesanan();

        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $query = $query->orderBy('route', 'asc')
            ->paginate(100)
            ->withQueryString();


        return view('content.pemesanan.pesanan.show_invoice', [
            'route' => "Invoice",
            'data' => $query,
            'search' => $search,
            'slug' => $slug
        ]);
    }

    public function show_order(Request $request, $slug)
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

}
