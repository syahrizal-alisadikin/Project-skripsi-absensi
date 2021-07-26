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
                                    <th>Nim</th>
                                    <th>Name</th>
                                    {{-- <th>Semester</th> --}}
                                    <th>Tahun</th>
                                   
                                   
                                </tr>
                            </thead>
                           
                            <tbody>
                                @forelse ($jadwal as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->mahasiswa->nim }}</td>
                                    <td>{{ $item->mahasiswa->name }}</td>
                                    {{-- <td>{{ $item->mahasiswa->fk_semester_id }}</td> --}}
                                    <td>{{ $item->mahasiswa->angkatan }}</td>
                                   
                                   
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Belum ada Mahasiwa</td>
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