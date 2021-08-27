@extends('layouts.dashboard-admin')

@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Dashboard  Admin</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">KELAS</li>
            </ol>
            
            
            <div class="card mb-4">
                <div class="card-header">
                    <a href="{{ route('kelas.create') }}" class="btn btn-success" style="float: right"><i class="fas fa-plus"></i> Kelas</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Matakuliah</th>
                                    <th>Dosen</th>
                                    <th>Aksi</th>
                                   
                                </tr>
                            </thead>
                           
                            <tbody>
                                @forelse ($kelas as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ $item->name  }}</td>
                                    <td>{{ $item->matkul->name }}</td>
                                    <td>{{ $item->dosen->name  }}</td>
                                    
                                    
                                    <td>
                                        <a href="{{ route('kelas.edit',$item->id) }}"  class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="#" class="btn btn-danger" onClick="Delete(this.id)"  id="{{ $item->id }}"><i class="far fa-trash-alt"></i></a>
                                        <a href="{{ route('kelas.show',$item->id) }}" class="btn btn-success" ><i class="far fa-user"></i></a>
                                    </td>
                                   
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada Kelas</td>
                                    </tr>
                                @endforelse
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>


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
                        url: "{{ route("kelas.index") }}/"+id,
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