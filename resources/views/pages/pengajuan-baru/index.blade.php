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
                // { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
        });
    });
</script>
@endpush
