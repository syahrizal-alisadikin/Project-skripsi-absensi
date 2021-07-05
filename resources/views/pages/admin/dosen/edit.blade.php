@extends('layouts.dashboard-admin')

@section('content')
    <main>
        <div class="container-fluid">
            {{-- <h1 class="mt-4">Dashboard  {{ Auth::guard('admin')->user()->name }}</h1> --}}
            <ol class="breadcrumb my-4">
                <li class="breadcrumb-item active">Edit Dosen</li>
            </ol>
            
           <div class="row">
               <div class="col-md-6">
               <div class="card">
                   <div class="card-body">
                            <form action="{{ route('dosen.update',$dosen->id) }}" method="POST">
                                @csrf
                                @method("PUT")
                                    <div class="form-group">
                                        <label for="name">Nidn </label>
                                        <input type="text" class="form-control @error('nidn') is-invalid @enderror" id="name" value="{{ $dosen->nidn ?? old('nidn') }}" name="nidn" required placeholder="Masukan Nidn...">
                                        @error('nidn')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name </label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ $dosen->name ?? old('name') }}" name="name" required placeholder="Masukan name...">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Email </label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $dosen->email ?? old('email') }}" required placeholder="Masukan email...">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone </label>
                                        <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $dosen->phone ?? old('phone') }}" required placeholder="Masukan phone...">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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


