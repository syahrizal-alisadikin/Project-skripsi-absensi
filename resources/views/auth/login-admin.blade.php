<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login Admin</title>
        <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-white" style="background-image: url('assets/assets/img/login.jpg')">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login Admin</h3></div>
                                    <div class="card-body">
                                        <form action="{{ route('postAuth-admin') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4 @error('email') is-invalid @enderror"  name="email" type="email" placeholder="Enter email address" />
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4 @error('password') is-invalid @enderror" name="password" id="inputPassword" type="password" placeholder="Enter password" />
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <button class="btn-primary btn-block py-2" type="submit" style="border-radius: 10px">Login</button>
                                                
                                            </div>
                                            {{-- <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.html">Forgot Password?</a>
                                                <a class="btn btn-primary" href="index.html">Login</a>
                                            </div> --}}
                                        </form>
                                    </div>
                                    {{-- <div class="card-footer text-center">
                                        <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            {{-- <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="text-center">
                            <div class="text-muted">Copyright &copy; Your Website {{ date('Y') }}</div>
                            
                        </div>
                    </div>
                </footer>
            </div> --}}
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/js/scripts.js') }}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
            //sweetalert for success or error message
            @if(session()->has('success'))
                Swal.fire({
                    icon: "success",
                    title: "BERHASIL!",
                    text: "{{ session('success') }}",
                    timer: 1500,
                    showConfirmButton: false,
                    showCancelButton: false,
                    buttons: false,
                });
                @elseif(session()->has('error'))
                Swal.fire({
                    icon: "error",
                    title: "Error !",
                    text: "{{ session('error') }}",
                    
                });
                @elseif(session()->has('info'))
                Swal.fire({
                    icon: "info",
                    title: "Info!",
                    text: "{{ session('info') }}",
                    
                });
                @endif
        </script>
    </body>
</html>
