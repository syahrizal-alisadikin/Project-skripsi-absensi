@extends('layouts.dashboard-admin')

@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Dashboard  Admin</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Mahasiswa</li>
            </ol>
            
            
            <div class="card mb-4">
                <div class="card-header">
                   <div class="row">
                       <div class="col-md-6 ">
                            <form action="{{ route('mahasiswa.index') }}" method="GET">
                                @csrf
                                <div class="d-flex">
                                    <div class="form-group">
                                    {{-- <label for="exampleFormControlSelect1">Angkatan</label> --}}
                                    <select class="form-control" name="filter">
                                    <option value="1">2019</option>
                                    <option value="2">2020</option>
                                    <option value="3">2021</option>
                                    <option value="4">2022</option>
                                    <option value="5">2021</option>
                                    </select>
                                </div>
                                 <div class="form-group ml-3">
                                   <Button type="submit" class="btn btn-warning">Filter</Button>
                                </div>
                                </div>
                            </form>
                       </div>
                       <div class="col-md-6">
                        <a href="{{ route('mahasiswa.create') }}" class="btn btn-success" style="float: right"><i class="fas fa-plus"></i> Mahasiswa</a>
                        <a href="javascript:void(0)" class="btn btn-primary mr-3"  data-toggle="modal" data-target="#exampleModal" style="float: right"><i class="fas fa-plus"></i> Import Mahasiswa</a>
                       </div>
                   </div>
                   
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Nim</th>
                                    <th>Name</th>
                                    <th>Jurusan</th>
                                    <th>Phone</th>
                                    <th>Semester</th>
                                    <th>Aksi</th>
                                   
                                </tr>
                            </thead>
                           
                            <tbody>
                                @forelse ($mahasiswa as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nim }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->jurusan->name }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->semester->name }}</td>
                                    <td>
                                        <a href="{{ route('mahasiswa.edit',$item->id) }}"  class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
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

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Mahasiswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('mahasiswa.import') }}" enctype="multipart/form-data">
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
                        url: "{{ route("mahasiswa.index") }}/"+id,
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