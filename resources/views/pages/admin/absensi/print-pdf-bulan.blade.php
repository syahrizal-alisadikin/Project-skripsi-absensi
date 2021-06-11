<html>
<head>
	<title>Laporan Absen Bulanan {{ $absen->pertemuan->matakuliah->name }} {{ $absen->pertemuan->name }}</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Laporan Absen Bulanan</h4>
		
		<h5>Matakuliah {{ $absen->pertemuan->matakuliah->name }}</h5>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr style="text-align: center">
				<th>No</th>
				<th>Pertemuan</th>
				<th>Mahasiswa</th>
				<th>Tanggal</th>
				<th>Status</th>
				
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			
				@forelse($absens as $p)
				<tr style="text-align: center">
					<td>{{ $i++ }}</td>
					<td>{{$p->pertemuan->name}}</td>
					<td>{{$p->mahasiswa->name}}</td>
					<td>{{$p->waktu}}</td>
					<td>{{$p->status}}</td>
					
				</tr>
                @empty
                <tr style="text-align: center">
                    <td colspan="5">Tidak Ada Absen Mahasiswa</td>
                </tr>
				@endforelse
		
		</tbody>
	</table>
 
</body>
</html>