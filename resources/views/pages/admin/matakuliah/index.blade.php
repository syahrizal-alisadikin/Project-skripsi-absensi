@extends('layouts.dashboard-admin')

@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Dashboard  Admin</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Matakuliah</li>
            </ol>
            
            
            <div class="card mb-4">
                <div class="card-header">
                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" style="float: right"><i class="fas fa-plus"></i> Matakuliah</a>
                    <a href="javascript:void(0)" class="btn btn-primary mr-3"  data-toggle="modal" data-target="#importModal" style="float: right"><i class="fas fa-plus"></i> Import Matakuliah</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Kode Matakuliah</th>
                                    <th>Matakuliah</th>
                                    <th>Sks</th>
                                    <th>Tahun</th>
                                    <th>Aksi</th>
                                   
                                </tr>
                            </thead>
                           
                            <tbody>
                                @forelse ($matkul as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->id_matkul }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->sks }}</td>
                                    <td>{{ $item->tahun }}</td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="ubahData('{{route('matkul.update',$item->id)}}','{{$item->name}}','{{$item->sks}}','{{$item->id_matkul}}','{{$item->id}}')" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="{{ route('matkul.show',$item->id) }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Pertemuan"><i class="far fa-eye"></i></a>
                                        <a href="#" class="btn btn-danger" onClick="Delete(this.id)"  id="{{ $item->id }}" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                   
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada Matakuliah</td>
                                    </tr>
                                @endforelse
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Matakuliah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('matkul.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Matakuliah</label>
                <input type="text" name="name" class="form-control" required placeholder="Masukan Nama Matakuliah" >
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">SKS</label>
                <input type="number" name="sks" class="form-control" required placeholder="Masukan sks" >
                
            </div>
            <div class="form-group">
                <label for="id_matkul">Kode Matkul</label>
                <input type="text" name="id_matkul" class="form-control" required placeholder="Masukan Kode" >
            </div>
            <div class="form-group">
                <label for="tahun">Tahun</label>
                <select name="tahun" class="form-control">
                    <option value="Genap">Genap</option>
                    <option value="Ganjil">Ganjil</option>
                </select>
            </div>
            
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
      
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="ubahModal" tabindex="-1" role="dialog" aria-labelledby="ubahModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Matakuliah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <form action="" id="ubah-data" method="post">
            @csrf
            @method('PUT')
            <input type="hidden" name="metode" id="metode">
            <input type="hidden" name="id" id="idnya">
            <div class="form-group">
                <label for="nbame">Name</label>
                <input type="hidden" class="form-control" id="idname" name="idname" required>
                <input type="text" class="form-control" id="editname" name="name" placeholder="Masukan Nama matakuliah" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">SKS</label>
                <input type="number" class="form-control" id="editsks" name="sks" placeholder="Masukan Nama sks" required>
                
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Kode Matakuliah</label>
                <input type="text" class="form-control" id="editkode" name="id_matkul" placeholder="Masukan Kode Matkul" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Tahun</label>
                <select name="tahun" class="form-control" id="">
                    <option value="Genap">Genap</option>
                    <option value="Ganjil">Ganjil</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Edit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>

      </div>
     
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Matakuliah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('matakuliah.import') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="mahasiswa">Pilih Excel Matakuliah</label>
                <input type="file" class="form-control-file" name="matakuliah" required id="matakuliah">
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
        $(function () {
        $('[data-toggle="tooltip"]').tooltip()
        })
        function ubahData(url,name,sks,kode,id) {
              $("#ubahModal").modal();
              $("#editname").val(name);
              $("#editsks").val(sks);
              $("#editkode").val(kode);
              document.getElementById('ubah-data').action = url;
               $("#idname").val(id);
        }

        

        $(document).ready(function() {

            $("#ubah-data").submit(function(e) {
                e.preventDefault(); // avoid to execute the actual submit of the form.
                var form = $(this);
                var url = form.attr('action');
                $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if (data.status == "success") {
                                 Swal.fire({
                                    title: 'BERHASIL!',
                                    text: 'DATA BERHASIL UPDATE!',
                                    icon: 'success',
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
            });


        });

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
                        url: "{{ route("matkul.index") }}/"+id,
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
