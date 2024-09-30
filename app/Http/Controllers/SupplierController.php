<?php

namespace App\Http\Controllers;

use App\Http\Services\SidebarService;
use App\Http\Services\SupplierService;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    private  SupplierService $supplierService;
    function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    public function index()
    {
        $isRole = SidebarService::getSidebarVisibility();
        $user = auth()->user();

        $supplier = $this->supplierService->getAllSupplier();
        return view('master.supplier', ['name' => __('messages.suppliers'), 'supplier' => $supplier, 'isRole' => $isRole, 'user' => $user]);
    }

    public function create(Request $request)
    {

        $validate = $request->validate([
            'nama' => 'required|string|max:255',
            'telepon' => 'nullable|string:max:25',
            'alamat' => 'nullable|string|max:255',
        ]);

        $this->supplierService->createSupplier($validate);

        return redirect()->route('master.supplier.index')->with('success', 'Berhasil Tambah');
    }

    public function destroy($id)
    {
        $this->supplierService->deleteSupplier($id);

        return redirect()->back()->with('success', 'Berhasil Hapus');
    }

    function update(Request $request)
    {
        $supplier = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:25'
        ]);

        $this->supplierService->updateSupplier($request->id_supplier, $supplier);

        return redirect()->route('master.supplier.index')->with('success', 'Berhasil Edit');
    }
}
