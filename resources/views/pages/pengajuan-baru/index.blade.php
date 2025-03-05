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
            <div class="d-flex justify-content-end">
                <a href="{{route('pengajuan.create')}}" class="btn btn-primary mx-2 mb-2">
                    Buat Pengajuan
                 </a>
                 <button type="button" class="btn btn-primary mx-2 mb-2" data-toggle="modal" data-target="#importModal">
                     Import
                  </button>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Pengajuan Baru</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="color: black">
                        <table id="pengajuan-table" class="table table-hover scroll-horizontal-vertical w-100 table-bordered table-striped" style="min-width: 845px; color:black">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Cabang</th>
                                    <th>Unit</th>
                                    <th>Nama PPBK</th>
                                    <th>Kode Outlet</th>
                                    <th>PIC</th>
                                    <th>Tanggal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Import Pengajuan baru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('pengajuan.import')}}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="modal-body">
                <label class="text-dark" for="">File</label>
                <input type="file" name="file" class="form-control">
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
            <button type="submit" class="btn btn-primary">Import</button>
            </div>
        </form>
      </div>
    </div>
</div>

<!-- Modal Edit Pengajuan Baru -->
<div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserLabel">Edit Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    @csrf
                    <input type="hidden" id="edit_id">

                    <div class="mb-3">
                        <label for="edit_cabang" class="form-label">Cabang</label>
                        <select name="cabang" id="edit_cabang" class="form-control" required>
                            @foreach ($cabangs as $item)
                                <option value="{{$item->nama_cabang}}">{{$item->nama_cabang}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_unit" class="form-label">Unit</label>
                        <input type="text" class="form-control" id="edit_unit" name="unit" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_nama_ppbk" class="form-label">Nama PPBK</label>
                        <input type="text" class="form-control" id="edit_nama_ppbk" name="nama_ppbk" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_kode_outlet" class="form-label">Kode Outlet</label>
                        <input type="text" class="form-control" id="edit_kode_outlet" name="kode_outlet" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_nama_outlet_baru" class="form-label">Nama Outlet Barus</label>
                        <input type="text" class="form-control" id="edit_nama_outlet_baru" name="nama_outlet_baru" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_sn" class="form-label">SN</label>
                        <input type="text" class="form-control" id="edit_sn" name="sn" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_merk_mesin" class="form-label">Merk Mesin</label>
                        <input type="text" class="form-control" id="edit_merk_mesin" name="merk_mesin" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_no_simcard" class="form-label">No Simcard</label>
                        <input type="text" class="form-control" id="edit_no_simcard" name="no_simcard" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_keterangan_stok_mesin" class="form-label">Keterangan Stok Mesin</label>
                        <select name="keterangan_stok_mesin" id="edit_keterangan_stok_mesin" class="form-control" required>
                           <option value="Stok Branch Office">Stok Branch Office</option>
                           <option value="Stok Regional Office">Stok Regional Office</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_merk_simcard" class="form-label">Merk Simcard</label>
                        <input type="text" class="form-control" id="edit_merk_simcard" name="merk_simcard" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="edit_keterangan" name="keterangan" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('add-script')
<script>
     $(function () {
        $('#pengajuan-table').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            ajax: '/pengajuan-baru/get-pengajuan',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'cabang', name: 'cabang' },
                { data: 'unit', name: 'unit' },
                { data: 'nama_ppbk', name: 'nama_ppbk' },
                { data: 'kode_outlet', name: 'kode_outlet' },
                { data: 'pic', name: 'pic' },
                { data: 'tanggal', name: 'tanggal' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
        });
    });

    $(document).on("click", ".edit-btn", function () {
        let id = $(this).data("id"); // Ambil ID dari tombol
        $.ajax({
            url: "/pengajuan-baru/" + id + "/edit", // API untuk mengambil data
            type: "GET",
            success: function (data) {
                $("#edit_id").val(data.id);
                $("#edit_cabang").val(data.cabang);
                $("#edit_unit").val(data.unit);
                $("#edit_nama_ppbk").val(data.nama_ppbk);
                $("#edit_kode_outlet").val(data.kode_outlet);
                $("#edit_kode_outlet").val(data.kode_outlet);
                $("#edit_nama_outlet_baru").val(data.nama_outlet_baru);
                $("#edit_sn").val(data.sn);
                $("#edit_merk_mesin").val(data.merk_mesin);
                $("#edit_no_simcard").val(data.no_simcard);
                $("#edit_keterangan_stok_mesin").val(data.keterangan_stok_mesin);
                $("#edit_merk_simcard").val(data.merk_simcard);
                $("#edit_keterangan").val(data.keterangan);
                $("#editUser").modal("show"); // Tampilkan modal
            },
            error: function () {
                alert("Gagal mengambil data!");
            },
        });
    });

    $("#editForm").submit(function (e) {
        e.preventDefault(); // Mencegah reload halaman

        let formData = {
            _token: $("input[name=_token]").val(),
            edit_id: $("#edit_id").val(),
            cabang: $("#edit_cabang").val(),
            unit: $("#edit_unit").val(),
            nama_ppbk: $("#edit_nama_ppbk").val(),
            kode_outlet: $("#edit_kode_outlet").val(),
            nama_outlet_baru: $("#edit_nama_outlet_baru").val(),
            sn: $("#edit_sn").val(),
            merk_mesin: $("#edit_merk_mesin").val(),
            no_simcard: $("#edit_no_simcard").val(),
            keterangan_stok_mesin: $("#edit_keterangan_stok_mesin").val(),
            merk_simcard: $("#edit_merk_simcard").val(),
            keterangan: $("#edit_keterangan").val(),
        };

        $.ajax({
            url: "/pengajuan-baru/update",
            type: "POST",
            data: formData,
            success: function (response) {
                $("#editUser").modal("hide"); // Tutup modal
                setTimeout(() => {
                    location.reload();
                }, 1000);

                toastr.success("Data berhasil diperbarui!"); // Toastr Success
            },
            error: function () {
                alert("Gagal memperbarui data!");
            },
        });
    });

    $(document).on("click", ".deleteButton", function () {
        let id = $(this).data("pengajuan-id"); // Ambil ID

        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data ini akan dihapus secara permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!",
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
