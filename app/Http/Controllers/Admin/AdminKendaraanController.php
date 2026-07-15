<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use App\Exports\KendaraanExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminKendaraanController extends Controller
{
    public function export()
    {
        return Excel::download(new KendaraanExport, 'kendaraan_' . date('Y-m-d') . '.xlsx');
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $kendaraans = Kendaraan::when($search, function ($query, $search) {
                            return $query->where('plat_nomor', 'LIKE', "%{$search}%")
                                         ->orWhere('merk', 'LIKE', "%{$search}%")
                                         ->orWhere('model', 'LIKE', "%{$search}%");
                        })
                        ->orderBy('created_at', 'desc')
                        ->get();
        
        return view('admin.kendaraan.index', compact('kendaraans', 'search'));
    }

    public function create()
    {
        return view('admin.kendaraan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'plat_nomor' => 'required|string|max:20|unique:kendaraans',
            'merk' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'warna' => 'required|string|max:30',
            'tahun' => 'required|integer|min:1900|max:' . date('Y'),
            // 'tipe' => 'required|in:mobil,motor,truk', // <-- HAPUS!
            // 'deskripsi' => 'nullable|string', // <-- HAPUS!
        ]);

        Kendaraan::create([
            'plat_nomor' => $request->plat_nomor,
            'merk' => $request->merk,
            'model' => $request->model,
            'warna' => $request->warna,
            'tahun' => $request->tahun,
        ]);

        return redirect()->route('admin.kendaraan.index')
            ->with('success', 'Kendaraan berhasil ditambahkan!');
    }

    public function show($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        return view('admin.kendaraan.show', compact('kendaraan'));
    }

    public function edit($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        return view('admin.kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        $request->validate([
            'plat_nomor' => 'required|string|max:20|unique:kendaraans,plat_nomor,' . $id,
            'merk' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'warna' => 'required|string|max:30',
            'tahun' => 'required|integer|min:1900|max:' . date('Y'),
            // 'tipe' => 'required|in:mobil,motor,truk', // <-- HAPUS!
            // 'deskripsi' => 'nullable|string', // <-- HAPUS!
        ]);

        $kendaraan->update([
            'plat_nomor' => $request->plat_nomor,
            'merk' => $request->merk,
            'model' => $request->model,
            'warna' => $request->warna,
            'tahun' => $request->tahun,
        ]);

        return redirect()->route('admin.kendaraan.index')
            ->with('success', 'Kendaraan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->delete();

        return redirect()->route('admin.kendaraan.index')
            ->with('success', 'Kendaraan berhasil dihapus!');
    }

    // HAPUS FUNCTION updateStatus() KARENA GA PAKAI STATUS!
    // public function updateStatus(Request $request, $id) { ... }
}