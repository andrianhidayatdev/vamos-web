<?php

namespace App\Http\Services;

use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SupplierService
{
  public function getAllSupplier()
  {
    $userCompanyId = Auth::user()->id_cabang;
    return Supplier::where('id_cabang', $userCompanyId)->get();
  }

  public function createSupplier(array $data)
  {
    $user = Auth::user();
    $userCompanyId = $user->id_cabang;
    $data['id_cabang'] = $userCompanyId;
    $data['user_id'] = $user->id;
    $data['user_id_last_update'] = $user->id;
    $supplier = Supplier::create($data);
    Log::channel('database')->info("{$data['nama']}", [
      'table_name' => 'supplier',
      'id_row' => $supplier->id_supplier,
      'action' => 'tambah',
      'context' => $data,
    ]);
  }

  public function updateSupplier($id, array $data)
  {
    $data['user_id_last_update'] = Auth::id();
    $supplier = Supplier::find($id);
    if ($supplier) {
      Log::channel('database')->info("{$supplier->nama} = {$data['nama']}", [
        'table_name' => 'supplier',
        'id_row' => $supplier->id_supplier,
        'action' => 'perbarui',
        'context' => ['before' => $supplier, 'after' => $data],
      ]);
      $supplier->update($data);
      return $supplier;
    }
    return null;
  }

  public function deleteSupplier($id)
  {
    $supplier = Supplier::find($id);
    if ($supplier) {
      Log::channel('database')->info("{$supplier->nama}", [
        'table_name' => 'supplier',
        'id_row' => $supplier->id_supplier,
        'action' => 'hapus',
        'context' => $supplier,
      ]);
      $supplier->delete();
      return true;
    }
    return false;
  }

  public function getSupplierById($id)
  {
    return $supplier = Supplier::find($id);
  }
}
