<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Pelanggan extends Authenticatable
{

    protected $guard = 'pelanggan';

    protected $table = 'pelanggan';
    
    protected $fillable = ['nama', 'email','alamat', 'password', 'no_hp'];

    protected $hidden = ['password'];

    public function keranjang() {
        return $this->hasMany(Keranjang::class);
    }
}
