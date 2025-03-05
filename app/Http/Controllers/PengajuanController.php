<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cabang;
use Illuminate\Http\Request;
use App\Models\PengajuanBaru;
use App\Imports\PengajuanImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class PengajuanController extends Controller
{
    public function index()
    {
        $cabangs = Cabang::all();
        return view('pages.pengajuan-baru.index', compact('cabangs'));
    }

    public function get_pengajuan_baru()
    {
        $pengajuan_baru = DB::table('pengajuan_barus')
                    ->select('id', 'cabang', 'unit', 'nama_ppbk', 'kode_outlet', 'pic', 'tanggal')
                    ->orderByDesc('created_at')
                    ->get();

        return DataTables::of($pengajuan_baru)
                ->addColumn('tanggal', function ($pengajuan_baru) {
                    return Carbon::parse($pengajuan_baru->tanggal)->format('d/m/Y');
                })
                ->addColumn('action', function ($pengajuan_baru) {
                    return '<div class="d-flex">
                                <button class="btn btn-info btn-sm edit-btn mx-1" data-bs-toggle="modal" data-bs-target="#editUser" data-id="' . $pengajuan_baru->id . '">
                                    <i class="fas fa-pencil-alt me-2"></i> Edit
                                </button>
                                <button class="btn btn-danger deleteButton mx-1" data-pengajuan-id="' . $pengajuan_baru->id . '">
                                    Hapus
                                </button>
                                <a href="/pengajuan-baru/detail/' . $pengajuan_baru->id . '" class="btn btn-primary mx-1">
                                    Detail
                                </a>
                            </div>';
                })
                ->rawColumns(['action']) // Tambahkan agar HTML tidak di-escape
                ->addIndexColumn()
                ->make(true);
    }

    public function detail($id)
    {
        $data = PengajuanBaru::findOrFail($id);
        $data->tanggal = Carbon::parse($data->tanggal)->format('d/m/Y');

        return view('pages.pengajuan-baru.detail', compact('data'));
    }

    public function create()
    {
        $cabangs = Cabang::select('nama_cabang')->get();
        return view('pages.pengajuan-baru.create', compact('cabangs'));
    }

    public function store(Request $request)
    {
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
            'tanggal' => Carbon::now(),
            'pic' => Auth::user()->name,
            'keterangan' => $request->keterangan,
        ]);

        Alert::success('Berhasil', 'Berhasil membuat pengajuan baru');

        return redirect()->back();
    }

    public function edit($id)
    {
        $pengajuan = PengajuanBaru::findOrFail($id);
        return response()->json($pengajuan);
    }

    public function update(Request $request)
    {
        $pengajuan = PengajuanBaru::findOrFail($request->edit_id);

        $pengajuan->update([
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
            'pic' => Auth::user()->name,
            'keterangan' => $request->keterangan,
            'updated_at' => Carbon::now(),
        ]);

        return response()->json(['success' => 'Data berhasil diperbarui!']);
    }

    public function destroy($id)
    {
        try {
            $pengajuan = PengajuanBaru::findOrFail($id);
            $pengajuan->delete();

            return response()->json(['success' => 'Pengajuan berhasil dihapus!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menghapus pengajuan!'], 500);
        }
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
