@extends('layouts.dashboard-dosen')

@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Dashboard Dosen</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Laporan Absensi Mahasiswa</li>
            </ol>
            
            
            <div class="card mb-4">
                <div class="card-header">
                    {{-- <a href="{{ route('dosen.create') }}" class="btn btn-success" style="float: right"><i class="fas fa-plus"></i> Dosen</a> --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Kelas</th>
                                    <th>Matakuliah</th>
                                  
                                    <th>Aksi</th>
                                   
                                </tr>
                            </thead>
                           
                            <tbody>
                                @forelse ($kelas as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name}}</td>
                                    <td>{{ $item->matkul->name }}</td>
                                    
                                    <td>
                                        <a href="{{ route('absensi.show',$item->fk_matkul_id) }}"  data-toggle="tooltip" data-placement="top" title="Lihat Pertemuan  " class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                    </td>
                                   
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada Absen</td>
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
