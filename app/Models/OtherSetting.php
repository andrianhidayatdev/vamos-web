<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherSetting extends Model
{
    use HasFactory;


    protected $table = 'other_setting';
    protected $primaryKey = 'id_other_setting';
    protected $fillable = ['bahasa', 'user_id'];
}
