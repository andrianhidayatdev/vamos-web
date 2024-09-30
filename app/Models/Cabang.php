<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;
    protected $table = 'cabang';
    protected $primaryKey = 'id_cabang';
    protected $fillable = ['nama_cabang'];

    public function setting()
    {
        return $this->hasOne(Setting::class, 'id_cabang', 'id_cabang');
    }

    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_cabang');
    }

    public function kategori()
    {
        return $this->hasMany(Kategori::class, 'id_cabang');
    }
    public function member()
    {
        return $this->hasMany(Member::class, 'id_cabang');
    }

    public function supplier()
    {
        return $this->hasMany(Supplier::class, 'id_cabang');
    }

    public function pengeluaran()
    {
        return $this->hasMany(Pengeluaran::class, 'id_cabang');
    }
}
