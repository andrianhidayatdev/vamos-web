<?php

namespace App\Http\Services;

use App\Models\Pengeluaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PengeluaranService
{
  public function getAllPengeluaran()
  {
    $userCompanyId = Auth::user()->id_cabang;

    return Pengeluaran::where('id_cabang', $userCompanyId)->get();
  }

  public function createPengeluaran(array $data)
  {
    $user = Auth::user();
    $userCompanyId = $user->id_cabang;
    $data['id_cabang'] = $userCompanyId;
    $data['user_id'] = $user->id;
    $pengeluaran = Pengeluaran::create($data);
    Log::channel('database')->info("{$pengeluaran->deskripsi}", [
      'table_name' => 'pengeluaran',
      'id_row' => $pengeluaran->id_pengeluaran,
      'action' => 'tambah',
      'context' => $pengeluaran,
    ]);
  }

  public function updatePengeluaran($id, array $data)
  {
    $pengeluaran = Pengeluaran::find($id);
    if ($pengeluaran) {
      $pengeluaran->update($data);
      return $pengeluaran;
    }
    return null;
  }

  public function deletePengeluaran($id)
  {
    $pengeluaran = Pengeluaran::find($id);
    if ($pengeluaran) {
      $pengeluaran->delete();
      return true;
    }
    return false;
  }

  public function getPengeluaranById($id)
  {
    return $pengeluaran = Pengeluaran::find($id);
  }
}
