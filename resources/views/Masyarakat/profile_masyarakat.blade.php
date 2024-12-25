@extends('layout_masyarakat.index')
@section('content')

<div class="page-wrapper">
  <div class="page-content">
    <div class="main-body">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="main-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Profile</li>
          </ol>
        </nav>
        <!-- /Breadcrumb -->
  
        <div class="row gutters-sm">
          <div class="col-md-4 mb-3">
            <div class="card">
              <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                  @if($profile->foto == null)
                  <img src="{{ asset('assets/img/profile/profile.jpg') }}" alt="Masyarakat" class="rounded-circle" width="150">
                  @endif
                  @if($profile->foto != null)
                  <img src="{{ asset('assets/img/profile/' .$profile->foto )}}" alt="Admin" class="rounded-circle" width="150">
                  @endif
                  <div class="mt-3">
                    <h4>{{ $profile->nama }}</h4>
                    <p class="text-secondary mb-1">{{ $profile->role }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card mb-3">
              <div class="card-body">
                <form method="POST" action="{{ url('/update_profile',$profile->id) }}" enctype="multipart/form-data">
                  @csrf
                  @method('PUT') 
                  <h4>Data Profile</h4>
                  <hr>
                    <div class="col-md-12">
                      <label for="nama" class="form-label">Nama</label>
                      <input type="text" class="form-control" name="nama" value="{{ $profile->nama}}" placeholder="Masukkan Nama">
                    </div>
                    <div class="col-md-12 mt-3">
                      <label for="email" class="form-label">Email</label>
                      <input type="text" class="form-control" name="email" value="{{ $profile->email}}" disabled>
                    </div>
                    <div class="col-md-12 mt-3">
                      <label for="no_telepon" class="form-label">Nomor Telepon</label>
                      <input type="text" class="form-control" name="no_telepon" value="{{ $profile->no_telepon}}" placeholder="Masukkan Email">
                    </div>
                    <div class="col-md-12 mt-3">
                      <label for="nik" class="form-label">NIK</label>
                      <input type="text" class="form-control" name="nik" value="{{ $profile->nik}}" placeholder="Masukkan NIK">
                    </div>

                    {{-- EDIT GENDER YANG LAMA (MASIH RADIO BUTTON) --}}
                    {{-- <div class="col-md-12 mt-3">
                    <label for="gender" class="form-label">Jenin Kelamin</label> <br>
                        @foreach($arr_gender as $jk )
                        @php 
                        $cek = ($jk == $profile->gender) ? 'checked' : ''; 
                        @endphp
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="gender" value="{{ $jk }}" {{ $cek }}>
                            <label class="form-check-label" for="gender">{{ $jk }}</label>
                        </div>
                        @endforeach
                    </div> --}}
                    
                    <div class="col-md-12 mt-3">
                      <label for="gender" class="form-label">Jenis Kelamin</label>
                        <select class="form-control" name="gender" id="gender" >
                          @foreach($arr_gender as $jk )
                          @php 
                            $cek = ($jk == $profile->gender) ? 'selected' : ''; 
                          @endphp
                            <option value="{{ $jk }}" {{ $cek }}>{{ $jk }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 mt-3">
                      <label for="alamat" class="form-label">Alamat</label>
                      <textarea class="form-control" id="alamat" name="alamat" cols="50" rows="5">{{ $profile->alamat }}</textarea>
                    </div>
                    <div class="col-md-12 mt-3">
                      <label for="foto" class="form-label">Foto</label>
                      <input type="file" class="form-control"  name="foto" />
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary  mt-4">Ubah</button>
                      <a href="{{url('/data_pengaduan')}}" class="btn btn-secondary mt-4">Batal</a>
                  </div>
                </form>  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection