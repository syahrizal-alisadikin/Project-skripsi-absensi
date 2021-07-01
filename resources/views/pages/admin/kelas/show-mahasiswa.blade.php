@extends('layouts.dashboard-admin')

@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Dashboard  Admin</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">KELAS {{ $kelas->name }}</li>
            </ol>
            
            
            <div class="card mb-4">
                <div class="card-header">
                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" style="float: right"><i class="fas fa-plus"></i> Mahasiswa</a>
                    <a href="javascript:void(0)" class="btn btn-primary mr-3"  data-toggle="modal" data-target="#ImportModal" style="float: right"><i class="fas fa-plus"></i> Import Mahasiswa</a>
                
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Nim</th>
                                    <th>Nama</th>
                                    <th>Jurusan</th>
                                    <th>Semester</th>
                                    <th>Aksi</th>
                                   
                                </tr>
                            </thead>
                           
                            <tbody>
                                @forelse ($jadwal as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->mahasiswa->nim }}</td>
                                    <td>{{ $item->mahasiswa->name }}</td>
                                    <td>{{ $item->mahasiswa->jurusan->name }}</td>
                                    <td>{{ $item->mahasiswa->semester->name }}</td>
                                    
                                    
                                    
                                    <td>
                                        <a href="#" class="btn btn-danger" onClick="Delete(this.id)"  id="{{ $item->id }}"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                   
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada Mahasiswa</td>
                                    </tr>
                                @endforelse
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Mahasiswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('jadwal.store') }}" method="POST">
            @csrf
           
            <div class="form-group">
                <label for="">Nama Mahasiswa</label> <br>
                <input type="hidden" value="{{ $kelas->id }}" name="fk_kelas_id">
                <select class="form-control" id="fk_mahasiswa_id" style="width:300px" name="fk_mahasiswa_id[]" multiple="multiple">
                    @foreach ($mahasiswa as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                    
                </select>
            </div>
            
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="ImportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Mahasiswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('kelas.import',$kelas->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="mahasiswa">Pilih Excel Mahasiswa</label>
                <input type="file" class="form-control-file" name="mahasiswa" required id="mahasiswa">
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
@endsection


@push('addon-script')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
    $('#fk_mahasiswa_id').select2({
        placeholder: 'Select Mahasiswa'
    });
});
</script>
    <script>
        function Delete(id)
        {
            var id = id;
            var token = $("meta[name='csrf-token']").attr("content");

            Swal.fire({
                title: "APAKAH KAMU YAKIN ?",
                text: "INGIN MENGHAPUS DATA INI!",
                showCancelButton: true,
                confirmButtonText: `Ya`,
            }).then((result) => {
                if (result.isConfirmed) {

                    //ajax delete
                    jQuery.ajax({
                        url: "{{ route("jadwal.index") }}/"+id,
                        data:   {
                            "id": id,
                            "_token": token
                        },
                        type: 'DELETE',
                        success: function (response) {
                            if (response.status == "success") {
                                Swal.fire({
                                    title: 'BERHASIL!',
                                    text: 'DATA BERHASIL DIHAPUS!',
                                    icon: 'success',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });
                            }else{
                                Swal.fire({
                                    title: 'GAGAL!',
                                    text: 'DATA GAGAL DIHAPUS!',
                                    icon: 'error',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });
                            }
                        }
                    });

                } else {
                    return true;
                }
            })
        }
    </script>
@endpush