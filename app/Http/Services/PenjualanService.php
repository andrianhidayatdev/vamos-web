<?php

namespace App\Http\Services;

use App\Models\Penjualan;
use Illuminate\Support\Facades\Auth;

class PenjualanService
{
  public function getAllPenjualan()
  {
    $user = Auth::id();

    return Penjualan::where('user_id', $user)->get();
  }

  public function createPenjualan(array $data)
  {
    $userCompanyId = Auth::user()->id_cabang;
    $data['id_cabang'] = $userCompanyId;

    return Penjualan::create($data);
  }

  public function updatePenjualan($id, array $data)
  {
    $penjualan = Penjualan::find($id);
    if ($penjualan) {
      $penjualan->update($data);
      return $penjualan;
    }
    return null;
  }

  public function deletePenjualan($id)
  {
    $penjualan = Penjualan::find($id);
    if ($penjualan) {
      $penjualan->delete();
      return true;
    }
    return false;
  }

  public function getPenjualanById($id)
  {
    return $penjualan = Penjualan::find($id);
  }
}
