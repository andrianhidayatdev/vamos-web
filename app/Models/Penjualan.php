<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';
    protected $primaryKey = 'id_penjualan';
    protected $fillable = ['total_item', 'total_harga', 'diskon', 'diterima', 'nama_customer', 'user_id', 'id_member'];

    public function member()
    {
        return $this->belongsTo(Member::class, 'id_member', 'id_member');
    }
}
