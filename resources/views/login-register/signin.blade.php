@extends('login-register.index')
@section('content')
@include('sweetalert::alert')

@if(Session::has('alert-success'))
  <script>
    Swal.fire({
        title: 'Success!',
        text: '{{ session('alert-success') }}',
        icon: 'success',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
    });
  </script>
@endif

<div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto bg-transparent mt-5">
    <div class="card card0 border-0">
        <div class="row d-flex">
            <div class="col-lg-5">
                <div class="card1 pb-5">
                    <div class="row px-3 justify-content-center mt-5 mb-5 border-line">
                        <img src="{{asset('assets/img/login.png')}}" class="image" style="width: 93%; height: auto;">
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card2 card border-0 px-3 py-5">
                    <div class="row px-3 mb-4">
                        <div class="line"></div>
                        <small class="or text-center">Login</small>
                        <div class="line"></div>
                    </div>
                  <form action="{{ route('signin.post') }}" method="POST">
                    @csrf
                    <div class="row px-3">
                        <label class="mb-1"><h6 class="mb-0 text-sm">Email</h6></label>
                        <input class="mb-4" type="email" value="{{ old('email') }}" name="email" placeholder="Masukkan Email">
                    </div>
                    <div class="row px-3">
                        <label class="mb-1"><h6 class="mb-0 text-sm">Password</h6></label>
                        <input type="password" name="password" placeholder="Masukkan Password">
                    </div>
                    <div class="row px-3 mb-4">
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input id="chk1" type="checkbox" name="chk" class="custom-control-input"> 
                            <label for="chk1" class="custom-control-label text-sm">Remember me</label>
                        </div>
                        <a href="#" class="ml-auto mb-0 text-sm">Forgot Password?</a>
                    </div>
                    <div class="row mb-3 px-3">
                        <button type="submit" name="submit" class="btn btn-blue text-center">Login</button>
                    </div>
                  </form>
                    <div class="row mb-4 px-3">
                        <small class="font-weight-bold">Belum punya akun ? <a href="{{ route ('daftar') }}" class="text-danger ">Daftar</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
