@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Hi, welcome back!</h4>
                {{-- <span class="ml-1">{{Auth::user()->name}}</span> --}}
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Pengajuan Baru</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Buat Pengajuan Baru</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('pengajuan.store')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row text-dark">
                            <div class="col-6">
                                <label for="">Cabang</label>
                                <select name="cabang" class="form-control select-cabang text-dark">
                                    <option value="">--Pilih Salah Satu--</option>
                                    @foreach ($cabangs as $item)
                                        <option value="{{$item->nama_cabang}}">{{$item->nama_cabang}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="">Unit</label>
                                <input type="text" name="unit" class="form-control">
                            </div>
                            <div class="col-6">
                                <label for="">Nama PPBK</label>
                                <input type="text" name="nama_ppbk" class="form-control">
                            </div>
                            <div class="col-6">
                                <label for="">Kode Outlet</label>
                                <input type="text" name="kode_outlet" class="form-control">
                            </div>
                            <div class="col-6">
                                <label for="">Nama Outlet Baru</label>
                                <input type="text" name="nama_outlet_baru" class="form-control">
                            </div>
                            <div class="col-6">
                                <label for="">SN</label>
                                <input type="text" name="sn" class="form-control">
                            </div>
                            <div class="col-6">
                                <label for="">Merk Mesin</label>
                                <input type="text" name="merk_mesin" class="form-control">
                            </div>
                            <div class="col-6">
                                <label for="">No Simcard</label>
                                <input type="text" name="no_simcard" class="form-control">
                            </div>
                            <div class="col-6">
                                <label for="">Keterangan Stok Mesin</label>
                                <select name="keterangan_stok_mesin" class="form-control" >
                                    <option value="">--Pilih Salah Satu--</option>
                                    <option value="Stok Branch Office">Stok Branch Office</option>
                                    <option value="Stok Regional Office">Stok Regional Office</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="">Merk Simcard</label>
                                <input type="text" name="merk_simcard" class="form-control">
                            </div>
                            <div class="col-6">
                                <label for="">Keterangan</label>
                                <input type="text" name="keterangan" class="form-control">
                            </div>
                        </div>
                        <div class="justify-content-end d-flex">
                            <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('add-script')
<script>
    $(document).ready(function() {
        $('.select-cabang').select2();
    });
</script>
@endpush
