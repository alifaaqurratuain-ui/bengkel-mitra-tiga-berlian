<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\CustomerExport;
use Maatwebsite\Excel\Facades\Excel;



class AdminCustomerController extends Controller
{
   public function index(Request $request)
{
    $search = $request->get('search');
    
    $customers = User::where('role', 'customer')
                    ->when($search, function ($query, $search) {
                        return $query->where('name', 'LIKE', "%{$search}%")
                                     ->orWhere('email', 'LIKE', "%{$search}%")
                                     ->orWhere('phone', 'LIKE', "%{$search}%");
                    })
                    ->orderBy('created_at', 'desc')
                    ->get();
    
    return view('admin.customers.index', compact('customers', 'search'));
}

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:3', // CUKUP 3 KARAKTER
        'phone' => 'nullable|string|max:15',
        'address' => 'nullable|string',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'phone' => $request->phone,
        'address' => $request->address,
        'role' => 'customer',
    ]);

    return redirect()->route('admin.customers.index')
        ->with('success', 'Customer berhasil ditambahkan!');
}

    public function edit($id)
    {
        $customer = User::findOrFail($id);
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
{
    $customer = User::where('role', 'customer')->findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'phone' => 'nullable|string|max:15',
        'address' => 'nullable|string',
    ]);

    $data = [
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
    ];

    if ($request->filled('password')) {
        $request->validate(['password' => 'min:3']); // CUKUP 3 KARAKTER
        $data['password'] = bcrypt($request->password);
    }

    $customer->update($data);

    return redirect()->route('admin.customers.index')
        ->with('success', 'Customer berhasil diupdate!');
}
    public function destroy($id)
    {
        $customer = User::findOrFail($id);
        $customer->delete();

        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer berhasil dihapus!');
    }
    public function export()
{
    return Excel::download(new CustomerExport, 'customer_' . date('Y-m-d') . '.xlsx');
}
}