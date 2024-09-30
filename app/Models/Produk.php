<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    protected $fillable = ['nama_produk', 'kode_produk', 'merk', 'harga_beli', 'harga_jual', 'diskon', 'stok', 'id_kategori', 'id_cabang', 'user_id', 'user_id_last_update'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function cabang()
    {
        return $this->belongsTo(User::class, 'id_cabang', 'id_cabang');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function users_last_update()
    {
        return $this->belongsTo(User::class, 'user_id_last_update');
    }
}
