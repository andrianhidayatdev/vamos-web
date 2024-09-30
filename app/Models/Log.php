<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $table = 'log';
    protected $primaryKey = 'id ';
    protected $fillable = ['level', 'message', 'context', 'table_name', 'action', 'id_row', 'user_id', 'id_cabang'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
