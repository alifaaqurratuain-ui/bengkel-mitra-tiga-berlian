<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomerExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::where('role', 'customer')
                    ->select('id', 'name', 'email', 'phone', 'address', 'created_at')
                    ->get();
    }

    public function headings(): array
    {
        return ['ID', 'Nama', 'Email', 'No. HP', 'Alamat', 'Tanggal Daftar'];
    }
}