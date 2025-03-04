<?php

namespace App\Imports;

use App\Models\StokGudang;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StokGudangImport implements ToModel,WithHeadingRow
{
    public function model(array $row)
    {
        return new StokGudang([
            'sn'              => $row['sn'],
            'merk'            => $row['merk'],
            'branch_office'   => $row['branch_office'],
            'keterangan'      => $row['keterangan'],
        ]);
    }
}
