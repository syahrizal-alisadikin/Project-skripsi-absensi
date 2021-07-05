@extends('layouts.dashboard-admin')

@section('content')
    <main>
        <div class="container-fluid">
            {{-- <h1 class="mt-4">Dashboard  {{ Auth::guard('admin')->user()->name }}</h1> --}}
            <ol class="breadcrumb my-4">
                <li class="breadcrumb-item active">Edit Mahasiswa</li>
            </ol>
            
           <div class="row">
               <div class="col-md-12">
               <div class="card">
                   <div class="card-body">
                            <form action="{{ route('mahasiswa.update',$mahasiswa->id) }}" method="POST">
                                @csrf
                                @method("PUT")
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Nim </label>
                                                <input type="number" class="form-control @error('nim') is-invalid @enderror" id="nim" value="{{ $mahasiswa->nim ?? old('nim') }}" name="nim" required placeholder="Masukan nim...">
                                                @error('nim')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Name </label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ $mahasiswa->name ?? old('name') }}" name="name" required placeholder="Masukan name...">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Email </label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $mahasiswa->email ?? old('email') }}" required placeholder="Masukan email...">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Phone </label>
                                                <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $mahasiswa->phone ?? old('phone') }}" required placeholder="Masukan phone...">
                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone">Angkatan </label>
                                                <select name="angkatan" id="angkatan" class="form-control">
                                                        <option value="2019" {{ $mahasiswa->anggatan == '2019' ? 'selected' : '' }}>2019</option>
                                                        <option value="2020" {{ $mahasiswa->anggatan == '2020' ? 'selected' : '' }}>2020</option>
                                                        <option value="2021" {{ $mahasiswa->anggatan == '2021' ? 'selected' : '' }}>2021</option>
                                                        <option value="2022" {{ $mahasiswa->anggatan == '2022' ? 'selected' : '' }}>2022</option>
                                                    
                                                </select>
                                                
                                              
                                            </div>
                                             <div class="form-group">
                                                <label for="phone">Jurusan </label>
                                                <select name="jurusan" id="jurusan" class="form-control">
                                                        <option value="Teknik Informatika" {{ $mahasiswa->jurusan == 'Teknik Informatika' ? 'selected' : '' }}>Teknik Informatika</option>
                                                        <option value="Sistem Informasi" {{ $mahasiswa->jurusan == 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
                                                    
                                                </select>
                                                
                                              
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Password </label>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"  placeholder="Masukan password...">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="confirm">Confirm Password </label>
                                                <input type="password" class="form-control" id="password" name="password_confirmation"   placeholder="Masukan password...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                                <button type="submit" class="btn-primary btn-block">Save</button>
                                    </div>
                                </form>
                        </div>
                   </div>
               </div>
           </div>
        </div>
    </main>


@endsection


