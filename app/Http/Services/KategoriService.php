<?php

namespace App\Http\Services;

use App\Models\Kategori;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class KategoriService
{
  public function getAllKategori()
  {
    $userCompanyId = Auth::user()->id_cabang;

    return Kategori::where('id_cabang', $userCompanyId)->get();
  }

  public function createKategori(array $data)
  {
    $user = Auth::user();
    $userCompanyId = $user->id_cabang;
    $data['id_cabang'] = $userCompanyId;
    $data['user_id'] = $user->id;
    $data['user_id_last_update'] = $user->id;

    $kategori  = Kategori::create($data);
    $data['id_kategori'] = $kategori->id_kategori;
    Log::channel('database')->info("{$kategori->nama_kategori}", [
      'table_name' => 'kategori',
      'id_row' => $kategori->id_kategori,
      'action' => 'tambah',
      'context' => $data,
    ]);
  }

  public function updateKategori($id, array $data)
  {
    $data['user_id_last_update'] = Auth::id();
    $kategori = Kategori::find($id);
    if ($kategori) {
      Log::channel('database')->info("{$kategori->nama_kategori} = {$data['nama_kategori']}", [
        'table_name' => 'kategori',
        'id_row' => $kategori->id_kategori,
        'action' => 'perbarui',
        'context' => ['before' => $kategori, 'after' => $data],
      ]);
      $kategori->update($data);
      return $kategori;
    }
    return null;
  }

  public function deleteKategori($id)
  {
    $kategori = Kategori::find($id);
    if ($kategori) {
      Log::channel('database')->info("{$kategori->nama_kategori}", [
        'table_name' => 'kategori',
        'id_row' => $kategori->id_kategori,
        'action' => 'hapus',
        'context' => $kategori,
      ]);
      $kategori->delete();
      return true;
    }
    return false;
  }

  public function getKategoriById($id)
  {
    return $kategori = Kategori::find($id);
  }
}
