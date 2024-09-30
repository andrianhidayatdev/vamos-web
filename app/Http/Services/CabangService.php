<?php

namespace App\Http\Services;

use App\Models\Cabang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CabangService
{
  public function getAllCabang()
  {
    return Cabang::all();
  }

  public function createCabang(array $data)
  {
    $cabang = Cabang::create($data);
    Log::channel('database')->info("{$data['nama_cabang']}", [
      'table_name' => 'cabang',
      'id_row' => $cabang->id_cabang,
      'action' => 'tambah',
      'context' => $cabang,
    ]);
  }

  public function updateCabang($id, array $data)
  {
    $cabang = Cabang::find($id);
    if ($cabang) {
      Log::channel('database')->info("{$cabang->nama_cabang} = {$data['nama_cabang']}", [
        'table_name' => 'cabang',
        'id_row' => $cabang->id_cabang,
        'action' => 'perbarui',
        'context' => ['before' => $cabang, 'after' => $data],
      ]);
      $cabang->update($data);
      return $cabang;
    }
    return null;
  }

  public function deleteCabang($id)
  {
    $cabang = Cabang::find($id);
    if ($cabang) {
      Log::channel('database')->info("{$cabang->nama_cabang}", [
        'table_name' => 'cabang',
        'id_row' => $cabang->id_cabang,
        'action' => 'hapus',
        'context' => $cabang,
      ]);
      $cabang->delete();
      return true;
    }
    return false;
  }

  public function getCabangById($id)
  {
    return $cabang = Cabang::find($id);
  }
}
