@extends('layouts.dashboard-dosen')

@section('content')
    <main>
        <div class="container-fluid">
            {{-- <h1 class="mt-4">Dashboard  {{ Auth::guard('admin')->user()->name }}</h1> --}}
            <ol class="breadcrumb my-4">
                <li class="breadcrumb-item active">Profile Dosen {{ $dosen->name }}</li>
            </ol>
            
           <div class="row">
               <div class="col-md-6">
               <div class="card">
                   <div class="card-body">
                            <form action="{{ route('updatePasswordDosen',$dosen->id) }}" method="POST">
                                @csrf
                                @method("PUT")
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Email </label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" readonly value="{{ $dosen->email ?? old('email') }}" required placeholder="Masukan email...">
                                        @error('email')
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