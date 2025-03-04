<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanBaru;
use App\Imports\PengajuanImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class PengajuanController extends Controller
{
    public function index()
    {
        return view('pages.pengajuan-baru.index');
    }

    public function get_pengajuan_baru()
    {
        $users = DB::table('pengajuan_barus')->select('cabang', 'unit', 'nama_ppbk', 'kode_outlet', 'pic', 'tanggal')->get();

        return DataTables::of($users)
                // ->addColumn('action', function ($users) {
                //     return '<button class="btn btn-info btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#editUser" data-id="' . $users->id . '"><i class="fas fa-pencil-alt me-2"></i>Edit</button>
                //             <button class="btn btn-danger deleteButton" data-user-id="'.$users->id.'">Hapus</button>';
                // })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
    }

    public function create()
    {
        return view('pages.pengajuan-baru.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'cabang' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
            'nama_ppbk' => 'required|string|max:255',
            'kode_outlet' => 'required|string|max:255',
            'nama_outlet_baru' => 'required|string|max:255',
            'sn' => 'nullable|string|max:255',
            'merk_mesin' => 'nullable|string|max:255',
            'no_simcard' => 'nullable|string|max:255',
            'keterangan_stok_mesin' => 'nullable|string|max:255',
            'merk_simcard' => 'nullable|string|max:255',
            'tanggal' => 'required|date',
            'pic' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        PengajuanBaru::create([
            'cabang' => $request->cabang,
            'unit' => $request->unit,
            'nama_ppbk' => $request->nama_ppbk,
            'kode_outlet' => $request->kode_outlet,
            'nama_outlet_baru' => $request->nama_outlet_baru,
            'sn' => $request->sn,
            'merk_mesin' => $request->merk_mesin,
            'no_simcard' => $request->no_simcard,
            'keterangan_stok_mesin' => $request->keterangan_stok_mesin,
            'merk_simcard' => $request->merk_simcard,
            'tanggal' => $request->tanggal,
            'pic' => $request->pic,
            'keterangan' => $request->keterangan,
        ]);

        Alert::success('Berhasil', 'Berhasil membuat pengajuan baru');

        return redirect()->back();
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        Excel::import(new PengajuanImport, $request->file('file'));

        Alert::success('Berhasil', 'Berhasil import data');

        return redirect()->back();
    }
}
