<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supllier extends Model
{
    use HasFactory;
    protected $table="suplliers";
    protected $guarded=[];

    public function supplier()
    {
        return $this->hasMany(Transaksi::class, 'id_supplier');
    }
    public function supplier2()
    {
        return $this->hasMany(Laporan::class, 'id_supplier');
    }
}
