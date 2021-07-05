@extends('layouts.dashboard-admin')

@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Dashboard Admin</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dosen</li>
            </ol>
            
            
            <div class="card mb-4">
                <div class="card-header">
                    <a href="{{ route('dosen.create') }}" class="btn btn-success" style="float: right"><i class="fas fa-plus"></i> Dosen</a>
                    <a href="javascript:void(0)" class="btn btn-primary mr-2 "  data-toggle="modal" data-target="#importModal" style="float: right"><i class="fas fa-plus"></i> Import Dosen</a>
                
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Nidn</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Aksi</th>
                                   
                                </tr>
                            </thead>
                           
                            <tbody>
                                @forelse ($dosen as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nidn ?? '-' }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>
                                        <a href="{{ route('dosen.edit',$item->id) }}"  class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="#" class="btn btn-danger" onClick="Delete(this.id)"  id="{{ $item->id }}"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                   
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada Dosen</td>
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
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Dosen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('dosen.import') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="mahasiswa">Pilih Excel Dosen</label>
                <input type="file" class="form-control-file" name="dosen" required id="dosen">
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
                        url: "{{ route("dosen.index") }}/"+id,
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