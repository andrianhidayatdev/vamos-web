<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $fillable = ['nama_kategori', 'user_id', 'id_cabang', 'user_id_last_update'];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_kategori');
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

    // public function log()
    // {
    //     $log = Log::where('id_kategori', $this->id)
    //         ->where('table_name', $this->table)
    //         ->where('action', 'perbarui')
    //         ->first();

    //     if (is_null($log)) {
    //         $log = Log::where('id_kategori', $this->id)
    //             ->where('table_name', $this->table)
    //             ->where('action', 'insert')
    //             ->first();
    //     }

    //     return $log;
    // }
}
