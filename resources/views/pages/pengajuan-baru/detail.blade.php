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
                    <h4 class="card-title">Detail Pengajuan Baru</h4>
                </div>
                <div class="card-body">
                    <div class="row text-dark">
                        <div class="col-6">
                            <label for="">Cabang</label>
                           <input type="text" class="form-control" value="{{$data->cabang}}" disabled>
                        </div>
                        <div class="col-6">
                            <label for="">Unit</label>
                            <input type="text" name="unit" class="form-control" value="{{$data->unit}}" disabled>
                        </div>
                        <div class="col-6">
                            <label for="">Nama PPBK</label>
                            <input type="text" name="nama_ppbk" class="form-control" value="{{$data->nama_ppbk}}" disabled>
                        </div>
                        <div class="col-6">
                            <label for="">Kode Outlet</label>
                            <input type="text" name="kode_outlet" class="form-control" value="{{$data->kode_outlet}}" disabled>
                        </div>
                        <div class="col-6">
                            <label for="">Nama Outlet Baru</label>
                            <input type="text" name="nama_outlet_baru" class="form-control" value="{{$data->nama_outlet_baru}}" disabled>
                        </div>
                        <div class="col-6">
                            <label for="">SN</label>
                            <input type="text" name="sn" class="form-control" value="{{$data->sn}}" disabled>
                        </div>
                        <div class="col-6">
                            <label for="">Merk Mesin</label>
                            <input type="text" name="merk_mesin" class="form-control" value="{{$data->merk_mesin}}" disabled>
                        </div>
                        <div class="col-6">
                            <label for="">No Simcard</label>
                            <input type="text" name="no_simcard" class="form-control" value="{{$data->no_simcard}}" disabled>
                        </div>
                        <div class="col-6">
                            <label for="">Keterangan Stok Mesin</label>
                            <input type="text" name="keterangan_stok_mesin" class="form-control" value="{{$data->keterangan_stok_mesin}}" disabled>
                        </div>
                        <div class="col-6">
                            <label for="">Merk Simcard</label>
                            <input type="text" name="merk_simcard" class="form-control" value="{{$data->merk_simcard}}" disabled>
                        </div>
                        <div class="col-6">
                            <label for="">Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" value="{{$data->keterangan}}" disabled>
                        </div>
                        <div class="col-6">
                            <label for="">PIC</label>
                            <input type="text" name="pic" class="form-control" value="{{$data->pic}}" disabled>
                        </div>
                        <div class="col-6">
                            <label for="">Tanggal</label>
                            <input type="text" name="tanggal" class="form-control" value="{{$data->tanggal}}" disabled>
                        </div>
                    </div>
                    <div class="justify-content-end d-flex">
                        <button class="btn btn-info approveButton mx-1" data-pengajuan-id="{{$data->id}}">
                            Approve
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('add-script')
    <script>
        $(document).on("click", ".approveButton", function () {
            let id = $(this).data("pengajuan-id"); // Ambil ID

            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Akan melakukan approve data ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Approve!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/pengajuan-baru/" + id, // API endpoint
                        type: "DELETE",
                        data: {
                            _token: $("meta[name='csrf-token']").attr("content"), // CSRF Token
                        },
                        success: function (response) {
                            Swal.fire("Deleted!", response.success, "success");
                            setTimeout(() => {
                                location.reload(); // Refresh tabel
                            }, 1500);
                        },
                        error: function () {
                            Swal.fire("Oops!", "Gagal menghapus data.", "error");
                        },
                    });
                }
            });
        });
    </script>
@endpush
