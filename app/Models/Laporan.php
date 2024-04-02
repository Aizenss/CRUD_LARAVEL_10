<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;
    protected $table = 'laporans';
    protected $guarded =[];
    public function supplier()
    {
        return $this->belongsTo(Supllier::class, 'id_supplier', 'id');
    }
    public function pengurus()
    {
        return $this->belongsTo(Pengurus::class, 'id_pengurus', 'id');
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id');
    }
}
