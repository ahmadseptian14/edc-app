<?php

namespace App\Imports;

use App\Models\PengajuanBaru;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PengajuanImport implements ToModel,WithHeadingRow
{
    public function model(array $row)
    {
        return new PengajuanBaru([
            'cabang'                => $row['cabang'],
            'unit'                  => $row['unit'],
            'nama_ppbk'             => $row['nama_ppbk'],
            'kode_outlet'           => $row['kode_outlet'],
            'nama_outlet_baru'      => $row['nama_outlet_baru'],
            'sn'                    => $row['sn'],
            'merk_mesin'            => $row['merk_mesin'],
            'no_simcard'            => $row['no_simcard'],
            'keterangan_stok_mesin' => $row['keterangan_stok_mesin'],
            'merk_simcard'          => $row['merk_simcard'],
            'tanggal'               => $row['tanggal'],
            'pic'                   => $row['pic'],
            'keterangan'            => $row['keterangan'],
        ]);
    }
}
