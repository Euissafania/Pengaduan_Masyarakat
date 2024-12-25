@extends('login-register.index')
@section('content')
@include('sweetalert::alert')

@if(Session::has('alert-success'))
  <div class="alert alert-success">
    <script>
      Swal.fire({
          title: 'Success!',
          text: '{{ session('alert-success') }}',
          icon: 'success',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'OK'
      });
    </script>
  </div>
@endif

<div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto bg-transparent mt-5">
    <div class="card card0 border-0">
        <div class="row d-flex">
            <div class="col-lg-5">
                <div class="card1 pb-5">
                    <div class="row px-3 justify-content-center mt-5 mb-5 border-line">
                        <img src="{{asset('assets/img/registrasi.png')}}" class="image" style="width: 80%; height: auto;">
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card2 card border-0 px-4 py-5">
                    <div class="row px-3 mb-4">
                        <div class="line"></div>
                        <small class="or text-center">Registrasi</small>
                        <div class="line"></div>
                    </div>
                  <form action="{{ route('daftar.post') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                    <div class="row px-3">
                        <label class="mb-1"><h6 class="mb-0 text-sm">Nama</h6></label>
                        <input class="mb-2" type="text" value="{{ old('nama') }}" name="nama"  placeholder="Masukkan Nama anda">
                    </div>
                    <div class="row px-3">
                        <label class="mb-1"><h6 class="mb-0 text-sm">Email</h6></label>
                        <input class="mb-2" type="email" value="{{ old('email') }}" name="email" placeholder="Masukkan alamat Email anda">
                    </div>
                    <div class="row px-3">
                        <label class="mb-1"><h6 class="mb-0 text-sm">Password</h6></label>
                        <input class="mb-2" type="password" name="password" placeholder="Masukkan Password minimal 6 karakter">
                    </div>
                    <div class="row px-3">
                        <label class="mb-1"><h6 class="mb-0 text-sm">NIK</h6></label>
                        <input class="mb-2" type="text" name="nik" value="{{ old('nik') }}" placeholder="Masukkan 16 digit NIK anda">
                    </div>
                    <div class="row px-3">
                        <label class="mb-1"><h6 class="mb-0 text-sm">No. Telepon</h6></label>
                        <input class="mb-2" type="text" name="no_telepon" value="{{ old('no_telepon') }}" placeholder="Masukkan nomor telepon anda">
                    </div>
                    <div class="row px-3">
                        <label class="mb-1"><h6 class="mb-0 text-sm">Alamat</h6></label>
                        <input class="mb-2" type="text" name="alamat" value="{{ old('alamat') }}" placeholder="Masukkan Alamat anda">
                    </div>
                    <div class="mb-3">
                      <label for="gender" class="form-label"><h6 class="mb-0 text-sm">Jenis Kelamin</h6></label>
                      <select class="form-control" name="gender" id="gender">
                        <option value="" disabled selected hidden>Pilih Jenis Kelamin</option>  
                        @foreach($arr_gender as $jk)
                              <option value="{{ $jk }}">{{ $jk }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="mb-3">
                    <label class="mb-1" for="foto" class="form-label"><h6 class="mb-0 text-sm">Foto</h6></label>
                    <input class="mb-2" type="file" class="form-control" name="foto" value="" placeholder="Pilih Foto"/>
                </div>
                <div class="row mb-3 px-3">
                    <button type="submit" name="submit" class="btn btn-blue text-center">Registrasi</button>
                </div>
              </form>
                    <div class="row mb-4 px-3">
                        <small class="font-weight-bold">Sudah punya akun ? <a href="{{ route ('signin') }}" class="text-danger ">Masuk</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
