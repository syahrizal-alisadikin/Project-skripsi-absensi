@extends('layouts.dashboard-dosen')

@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Dashboard  Dosen</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Matakuliah</li>
                 {{-- <li class="breadcrumb-item active" aria-current="page">{{ $pertemuan->matakuliah->first()->name }}</li> --}}
            </ol>
            
            
            <div class="card mb-4">
                <div class="card-header d-flex">
                    {{-- <h5>{{ $pertemuan->matakuliah->first()->name }}</h5> --}}
                    {{-- <a href="#" class="btn btn-success ml-auto" data-toggle="modal" data-target="#exampleModal" ><i class="fas fa-plus"></i> Pertemuan</a> --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Matakuliah</th>
                                    <th>Name</th>
                                    <th>Tanggal</th>
                                    <th>Expired Absen</th>
                                    <th>Aksi</th>
                                   
                                </tr>
                            </thead>
                           
                            <tbody>
                                @forelse ($pertemuan as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->matakuliah->name }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->expired_absen ?? "-" }}</td>
                                    <td>
                                        @if ($item->expired_absen == null)
                                        <a href="javascript:void(0)" onclick="ubahData('{{route('update',$item->id)}}','{{$item->name}}','{{$item->tanggal}}','{{$item->id}}')" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Edit Pertemuan"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="{{ route('generateAbsen',$item->id) }}"  class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Generate Absen"><i class="fas fa-eye"></i></a>
                                        @else
                                        <a href="{{ route('AddTimeAbsen',$item->id) }}"  class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Tambah Waktu Absen"><i class="far fa-clock"></i></a>
                                        <a href="{{ route('generateView',$item->id) }}"  class="btn btn-success" data-toggle="tooltip" data-placement="top" title="lihat Absen"><i class="fas fa-eye"></i></a>

                                        @endif
                                        {{-- <a href="javascript:void(0)" onclick="ubahData('{{route('pertemuan.update',$item->id)}}','{{$item->name}}','{{$item->tanggal}}','{{$item->id}}')" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a> --}}
                                        {{-- <a href="#" class="btn btn-danger" onClick="Delete(this.id)"  id="{{ $item->id }}" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="far fa-trash-alt"></i></a> --}}
                                    </td>
                                   
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada Pertemuan</td>
                                    </tr>
                                @endforelse
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
<div class="modal fade" id="ubahModal" tabindex="-1" role="dialog" aria-labelledby="ubahModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Pertemuan</h5>
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
                <label for="exampleInputEmail1">Tanggal</label>
                <input type="date" class="form-control" id="editsks" name="tanggal" required>
                
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

@endsection

@push('addon-script')
<script>
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
 

</script>
<script>
    $('#tanggal').datepicker({
            format: 'Y-m-d',
        });
        function ubahData(url,name,sks,id) {
              $("#ubahModal").modal();
              $("#editname").val(name);
              $("#editsks").val(sks);
              document.getElementById('ubah-data').action = url;
               $("#idname").val(id);
        }

        

        $(document).ready(function() {
            $("#ubah-data").submit(function(e) {
                e.preventDefault(); // avoid to execute the actual submit of the form.
                var form = $(this);
                var url = form.attr('action');
                $.ajax({
                type: "PUT",
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
</script>
@endpush