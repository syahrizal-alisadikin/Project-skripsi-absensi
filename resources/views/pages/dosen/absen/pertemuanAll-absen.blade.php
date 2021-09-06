@extends('layouts.dashboard-dosen')

@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Dashboard Dosen</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Laporan Absensi / Mahasiswa</li>
            </ol>
            
            
            <div class="card mb-4">
                <div class="card-header">
                    {{-- <a href="{{ route('dosen.create') }}" class="btn btn-success" style="float: right"><i class="fas fa-plus"></i> Dosen</a> --}}
                    <a href="{{ route('export.pertemuan-showAll',$kelas->fk_matkul_id) }}" data-toggle="tooltip" data-placement="top" title="Export Ke Excel"  class="btn btn-primary">Export Excel</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>Nim</th>
                                    <th>Nama</th>
                                    @foreach ($pertemuan as $item)

                                        <th>P{{ $loop->iteration }}</th>
                                    @endforeach
                                    <th>Total Hadir</th>
                                   
                                </tr>
                            </thead>
                           
                            <tbody>
                                @forelse ($mahasiswa as $item)
                                <tr class="text-center">
                                  
                                    <td>{{ $item->mahasiswa->nim ?? null}}</td>
                                    <td>{{ $item->mahasiswa->name ?? null}}</td>
                                    @foreach ($pertemuan as $pertemu)
                                        @php
                                            $data = App\Models\Absen::where('fk_mahasiswa_id',$item->mahasiswa->id ?? null)->where('fk_pertemuan_id',$pertemu->id)->first();
                                            $count = App\Models\Absen::where('fk_mahasiswa_id',$item->mahasiswa->id ?? null)->whereIn('fk_pertemuan_id',$pertemuanPluck)->count();
                                        @endphp
                                       <td>
                
                                         {{ $data->status ?? ''}}
                                       </td>
                                    @endforeach
                                    <td>{{ $count }}</td>
                                    
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
            {{-- @if (count($absen) > 0)
                 <div class="card">
              <div class="card-header d-flex">
                <div class="data">
                  Print Data Bulan Dan Harian
                </div>
              </div>
              <div class="card-body">
                  <div class="col-lg-12">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="data">
                          Print PDF 1 Bulan
                        </div><br>
                        <form method="GET" action="{{ route('print_pdf_bulan_dosen',$id) }}">
                          <div class="form-group">
                            <div class="ml-auto">
                              <input class="form-control" type="date" name="tanggal_start" value="{{ date('Y-m-d') }}">
                            </div>
                          </div>
                          <div class="form-group">                
                            <div class="ml-auto">
                              <input class="form-control" type="date" name="tanggal_end">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="button">        
                              <button class="btn btn-danger btn-sm">Print PDF</button>
                            </div> 
                          </div> 
                        </form>
                      </div>
                      <div class="col-lg-6">
                        <div class="data">
                          Print PDF Per Hari
                        </div><br>
                        <form method="GET" action="{{ route('print_pdf_dosen',$id) }}">
                          <div class="form-group">
                            <input class="form-control" type="date" name="tanggal_start" value="{{ date('Y-m-d') }}">
                          </div>
                          <button class="btn btn-danger btn-sm" type="submit">Print PDF</button>
                        </form> 
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            @endif --}}
        </div>
    </main>


@endsection


