@extends('layouts.dashboard-dosen')

@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Dashboard  Dosen</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Generate Absen</li>
            </ol>
            
            
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card mb-4">
               
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="alert alert-primary text-center" role="alert">
                                    Absen berhasil di generate
                                </div>
                                <div class=" text-center" role="alert">
                                    Expired {{$pertemuan->expired_absen}}
                                </div>
                                 <div class="text-center">
                                    <a href="https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl={{$pertemuan->id}}&choe=UTF-8" download="https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl={{$pertemuan->id}}&choe=UTF-8">
                                    <img src="https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl={{$pertemuan->id}}&choe=UTF-8" alt="">
                                    </a>
                                <br>
                                    <a href="https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl={{$pertemuan->id}}&choe=UTF-8" download="code" id="download" class="btn btn-success">Download</a>
                                    <a href="{{ route('matakuliah.pertemuan',$pertemuan->fk_matkul_id) }}" class="btn btn-primary">Kembali</a>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


@endsection


