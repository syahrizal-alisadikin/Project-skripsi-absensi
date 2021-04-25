@extends('layouts.dashboard-admin')

@section('content')
    <main>
        <div class="container-fluid">
            {{-- <h1 class="mt-4">Dashboard  {{ Auth::guard('admin')->user()->name }}</h1> --}}
            <ol class="breadcrumb my-4">
                <li class="breadcrumb-item active">Tambah Mahasiswa</li>
            </ol>
            
           <div class="row">
               <div class="col-md-12">
               <div class="card">
                   <div class="card-body">
                            <form action="{{ route('mahasiswa.store') }}" method="POST">
                                @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Nim </label>
                                                <input type="number" class="form-control @error('nim') is-invalid @enderror" id="nim" value="{{ old('nim') }}" name="nim" required placeholder="Masukan nim...">
                                                @error('nim')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Name </label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" name="name" required placeholder="Masukan name...">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Email </label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required placeholder="Masukan email...">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Phone </label>
                                                <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required placeholder="Masukan phone...">
                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone">Semester </label>
                                                <select name="fk_semester_id" id="fk_semester_id" class="form-control">
                                                    @foreach ($semester as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                
                                              
                                            </div>
                                             <div class="form-group">
                                                <label for="phone">Jurusan </label>
                                                <select name="fk_jurusan_id" id="fk_jurusan_id" class="form-control">
                                                    @foreach ($jurusan as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                
                                              
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Password </label>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required placeholder="Masukan password...">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="confirm">Confirm Password </label>
                                                <input type="password" class="form-control" id="password" name="password_confirmation"  required placeholder="Masukan password...">
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


