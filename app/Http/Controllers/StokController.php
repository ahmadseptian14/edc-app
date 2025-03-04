<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\StokGudangImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class StokController extends Controller
{
    public function index()
    {
        return view('pages.stok.index');
    }

    public function get_stoks()
    {
        $users = DB::table('stok_gudangs')->get();

        return DataTables::of($users)
                // ->addColumn('action', function ($users) {
                //     return '<button class="btn btn-info btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#editUser" data-id="' . $users->id . '"><i class="fas fa-pencil-alt me-2"></i>Edit</button>
                //             <button class="btn btn-danger deleteButton" data-user-id="'.$users->id.'">Hapus</button>';
                // })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        Excel::import(new StokGudangImport, $request->file('file'));

        Alert::success('Berhasil', 'Berhasil import data');

        return redirect()->back();
    }
}
