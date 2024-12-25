@extends('layout_masyarakat.index')
@section('content')
 
<div class="page-wrapper">
<div class="page-content">
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
  <div class="breadcrumb-title pe-3">Masyarakat</div>
  <div class="ps-3">
      <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
              <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">Ajukan Pengaduan</li>
          </ol>
      </nav>
  </div>
</div>
<!--end breadcrumb-->
<div class="card">
    <h4 class="card-header">Ajukan Pengajuan</h4>
    <div class="card-body">

        <br />
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url('store') }}"  enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="nama_pengaduan" class="form-label">Pengaduan</label>
              <input type="text" class="form-control @error('nama_pengaduan') is-invalid @else is-valid @enderror" id="nama_pengaduan" name="nama_pengaduan"
                value="{{ old('nama_pengaduan') }}">
                @error('nama_pengaduan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
              <input type="hidden" class="form-control" id="masyarakat_id" name="masyarakat_id" value="{{ $join->id }}">
            </div>
            <div class="mb-3">
              <label for="lokasi_pengaduan" class="form-label">Lokasi Pengaduan</label>
              <textarea class="form-control @error('lokasi_pengaduan') is-invalid @else is-valid @enderror" id="lokasi_pengaduan" name="lokasi_pengaduan" cols="50" rows="5">{{ old('lokasi_pengaduan') }}</textarea>
              @error('lokasi_pengaduan')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="deskripsi" class="form-label">Deskripsi Pengaduan</label>
              <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @else is-valid @enderror" cols="50" rows="5">{{ old('deskripsi') }}</textarea>
              @error('deskripsi')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="foto_pengaduan" class="form-label">Foto Pengaduan</label>
              <input type="file" class="form-control @error('foto_pengaduan') is-invalid @else is-valid @enderror"  name="foto_pengaduan" value="" />
              @error('foto_pengaduan')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary  mt-4">Simpan</button>
                <a href="{{url('pengaduan')}}" class="btn btn-secondary mt-4">Batal</a>
            </div>
        </form>
    </div>
</div>
</div>
</div>
<script>
      $('#summernote').summernote({
        placeholder: 'Masukkan Deskripsi Pengaduan',
        tabsize: 2,
        height: 100
      });
    </script>
@endsection

