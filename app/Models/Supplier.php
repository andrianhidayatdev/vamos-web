<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'supplier';
    protected $primaryKey = 'id_supplier';
    protected $fillable = ['nama', 'alamat', 'telepon', 'id_cabang', 'user_id', 'user_id_last_update'];

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
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
