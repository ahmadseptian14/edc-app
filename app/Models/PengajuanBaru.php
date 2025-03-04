<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanBaru extends Model
{
    use HasFactory;

    protected $fillable = ['cabang', 'unit', 'nama_ppbk', 'kode_outlet', 'nama_outlet_baru', 'sn', 'merk_mesin', 'no_simcard', 'keterangan_stok_mesin', 'merk_simcard', 'tanggal', 'pic', 'keterangan'];
}
