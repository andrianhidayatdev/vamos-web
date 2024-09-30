<?php

namespace App\Http\Services;

use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProdukService
{
  public function getAllProduk()
  {
    $userCompanyId = Auth::user()->id_cabang;
    $posts = Produk::leftJoin('kategori', 'produk.id_kategori', '=', 'kategori.id_kategori')
      ->where('produk.id_cabang', $userCompanyId)
      ->select('produk.*', 'kategori.nama_kategori as nama_kategori')
      ->get();

    return $posts;
  }

  public function createProduk(array $data)
  {

    $data['kode_produk'] = $this->genereteKodeProduk();

    if (!isset($data['id_kategori'])) {
      $data['id_kategori'] = null;
    }
    $users = Auth::user();
    $data['user_id'] = $users->id;
    $data['user_id_last_update'] = $users->id;
    $userCompanyId = $users->id_cabang;
    $data['id_cabang'] = $userCompanyId;
    $produk = Produk::create($data);
    Log::channel('database')->info($data['nama_produk'], [
      'table_name' => 'produk',
      'id_row' => $produk->id_produk,
      'action' => 'tambah',
      'context' => $data,
    ]);
  }

  public function updateProduk($id, array $data)
  {
    $data['user_id_last_update'] = Auth::id();
    $produk = Produk::find($id);
    if ($produk) {
      Log::channel('database')->info("{$produk->nama_produk} = {$data['nama_produk']} ", [
        'table_name' => 'produk',
        'id_row' => $produk->id_produk,
        'action' => 'perbarui',
        'context' => ['before' => $produk, 'after' => $data],
      ]);
      $produk->update($data);
      return $produk;
    }
    return null;
  }

  public function deleteProduk($id)
  {
    $produk = Produk::find($id);
    if ($produk) {
      Log::channel('database')->info("{$produk->nama_produk} ", [
        'table_name' => 'produk',
        'id_row' => $produk->id_produk,
        'action' => 'hapus',
        'context' => $produk,
      ]);
      $produk->delete();
      return true;
    }
    return false;
  }

  public function getProdukById($id)
  {
    return $produk = Produk::find($id);
  }

  private function genereteKodeProduk()
  {
    $lastproduk = Produk::orderBy('id_produk', 'desc')->first();
    if ($lastproduk) {
      $lastKode = (int)substr($lastproduk->kode_produk, 3); // Ubah ke tipe integer
      $newKode = 'PDK' . str_pad($lastKode + 1, 3, '0', STR_PAD_LEFT);
    } else {
      $newKode = 'PDK001';
    }
    return $newKode;
  }
}
