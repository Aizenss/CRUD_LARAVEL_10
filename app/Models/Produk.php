<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produks';
    protected $guarded =[];
    public function kategori(){
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    }
    public function kategori2()
    {
        return $this->hasMany(Transaksi::class, 'id_produk');
    }
    public function kategori3()
    {
        return $this->hasMany(Laporan::class, 'id_produk');
    }
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_produk', 'id');
    }
}
