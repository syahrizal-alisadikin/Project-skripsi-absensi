<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Absen Pertemuan {{ $kelas->matkul->name }}</title>
</head>
<body>
    <div class="card-body">
                    <div class="table-responsive">
                        Rekap {{ count($pertemuan) }} Pertemuan {{ $kelas->matkul->name }}
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                           
                            <thead>
                                <tr> Rekap {{ count($pertemuan) }} Pertemuan {{ $kelas->matkul->name }}</tr>
                                <tr class="text-center">
                                    <th>Nim</th>
                                    <th>Nama</th>
                                    @foreach ($pertemuan as $item)
                                        <th>{{ $item->name }}</th>
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
</body>
</html>