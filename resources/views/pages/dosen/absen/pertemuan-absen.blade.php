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
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Nim</th>
                                    <th>Mahasiswa</th>
                                    <th>Status</th>
                                   
                                </tr>
                            </thead>
                           
                            <tbody>
                                @forelse ($absen as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->mahasiswa->nim}}</td>
                                    <td>{{ $item->mahasiswa->name}}</td>
                                    <td>@if ($item->status == "hadir")
                                        <span class="badge badge-success">Hadir</span>
                                        @else
                                        <span class="badge badge-warning">Terlambat</span>

                                        @endif
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
            @if (count($absen) > 0)
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
            @endif
        </div>
    </main>


@endsection


