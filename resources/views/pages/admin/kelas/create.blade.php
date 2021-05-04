@extends('layouts.dashboard-admin')

@section('content')
    <main>
        <div class="container-fluid">
            {{-- <h1 class="mt-4">Dashboard  {{ Auth::guard('admin')->user()->name }}</h1> --}}
            <ol class="breadcrumb my-4">
                <li class="breadcrumb-item active">Tambah Kelas</li>
            </ol>
            
           <div class="row">
               <div class="col-md-6">
               <div class="card">
                   <div class="card-body">
                            <form action="{{ route('kelas.store') }}" method="POST">
                                @csrf
                                    
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
                                        <label for="name">Matakuliah </label>
                                        <select name="fk_matkul_id" id="fk_matkul_id" class="form-control">
                                            @foreach ($matkul as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Dosen </label>
                                           <select name="fk_dosen_id" id="fk_dosen_id" class="form-control">
                                            @foreach ($dosen as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                           </select>
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


