<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    use HasFactory;
    protected $table = "penguruses";
    protected $guarded =[];

    public function pengurus()
    {
        return $this->hasMany(Transaksi::class, 'id_pengurus');
    }
    public function pengurus2()
    {
        return $this->hasMany(Laporan::class, 'id_pengurus');
    }
}
