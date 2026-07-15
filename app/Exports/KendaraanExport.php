<?php

namespace App\Exports;

use App\Models\Kendaraan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KendaraanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Kendaraan::select('id', 'plat_nomor', 'merk', 'model', 'warna', 'tahun', 'tipe', 'created_at')
                        ->get();
    }

    public function headings(): array
    {
        return ['ID', 'Plat Nomor', 'Merk', 'Model', 'Warna', 'Tahun', 'Tipe', 'Tanggal Ditambahkan'];
    }
}