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
                                    <td>{{ $item->matakuliah->first()->name }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->expired_absen ?? "-" }}</td>
                                    <td>
                                        @if ($item->expired_absen == null)
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
                                        <td colspan="4" class="text-center">Belum ada Pertemuan</td>
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
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
@endpush