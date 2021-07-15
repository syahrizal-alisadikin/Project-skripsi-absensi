@extends('layouts.dashboard-dosen')

@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Dashboard  Dosen</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Matakuliah</li>
            </ol>
            
            
            <div class="card mb-4">
                <div class="card-header">
                    {{-- <a href="{{ route('kelas.create') }}" class="btn btn-success" style="float: right"><i class="fas fa-plus"></i> Kelas</a> --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Matakuliah</th>
                                    <th>Jurusan</th>
                                    <th>Aksi</th>
                                   
                                </tr>
                            </thead>
                           
                            <tbody>
                                @forelse ($matkul as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->id_matkul }}</td>
                                    <td>{{ $item->jadwal->first()->mahasiswa->jurusan->name }}</td>
                                    {{-- <td>{{ $item->sks }}</td> --}}
                                    
                                    
                                    <td>
                                        <a href="{{ route('matakuliah.pertemuan',$item->fk_matkul_id) }}"  class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('matakuliah.mahasiswa',$item->id) }}"  class="btn btn-success"><i class="far fa-user"></i></a>
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


