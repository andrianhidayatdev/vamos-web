<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'id_role',
        'foto',
        'password',
        'id_cabang',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }



    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }

    public function produk()
    {
        return $this->hasMany(Produk::class, 'user_id');
    }

    public function kategori()
    {
        return $this->hasMany(Kategori::class, 'user_id');
    }

    public function supplier()
    {
        return $this->hasMany(Supplier::class, 'user_id');
    }

    public function member()
    {
        return $this->hasMany(Member::class, 'user_id');
    }
    public function other_setting()
    {
        return $this->hasOne(OtherSetting::class, 'user_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
