@extends('layout_admin.index')
@section('content')

<div class="page-wrapper">
    <div class="page-content">
      <!--breadcrumb-->
      <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Admin</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Tanggapan Pengaduan</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
        <div class="card">
            <div class="row">
              <div class="col-md-6">
                <center>
                <img src="{{ asset('assets/img/pengaduan/'. $dataPengaduan->foto_pengaduan) }}" alt="foto_pengaduan" width="100%" class="d-flex">
                </center>
              </div>
              <div class="col-md-6">
                <div class="card-body">
                 <h4 class="card-title">Data Pengaduan Masyarakat</h4>
                 <hr>
                 <table width="90%" cellpadding="10">
                    <tbody>
                        <tr>
                        <td width="40%">Nama Masyarakat</td>
                        <td width="3%">:</td>
                        <td>{{ $dataPengaduan->nama }}</td>
                        </tr>
                        <tr>
                        <td>Pengaduan </td>
                        <td>:</td>
                        <td>{{ $dataPengaduan->nama_pengaduan }}</td>
                        </tr>
                        <tr>
                        <td>Tanggal Pengaduan</td>
                        <td>:</td>
                        <td>{{ \Carbon\Carbon::parse($dataPengaduan->tgl_pengaduan)->format('l, d F Y')  }}</td>
                        </tr>
                        <tr>
                        <td>Lokasi Pengaduan</td>
                        <td>:</td>
                        <td>{{ $dataPengaduan->lokasi_pengaduan }}</td>
                        </tr>  
                        <tr>
                        <td>Deskripsi Pengaduan</td>
                        <td>:</td>
                        <td>{!! $dataPengaduan->deskripsi !!}</td>
                        </tr>  

                        @if($dataTanggapan != Null)
                        <tr>
                        <td>Tanggal Tanggapan Pengaduan</td>
                        <td>:</td>
                        <td>{{\Carbon\Carbon::parse($dataTanggapan->tgl_tanggapan)->format('l, d F Y')  }}</td>
                        </tr>
                        <tr>  
                        <td>Keterangan</td>
                        <td>:</td>
                        <td>{{$dataTanggapan->keterangan }}</td>
                        </tr>
                        @endif
                    </tbody>
                 </table> 
                </div>
              </div>
            </div>
           
          </div>
          <br>
          <div class="card">
            <h4 class="card-header">Tanggapan Pengaduan</h4>
            <div class="card-body">
              <form method="POST" action="{{ url('update_data',$dataPengaduan->id) }}">
                @csrf
                @method('PUT') 
                  <div class="col-md-12">
                    <label for="basic-url" class="form-label">Status Pengaduan</label>
                    <select name="status" class="form-select">
                        <option>-- Pilih Status Pengaduan --</option>
                        @php 
                        $arr_status = ['Belum diproses', 'Proses', 'Selesai'];
                        @endphp
                        @foreach($arr_status as $status )
                        @php 
                        $cek = ($status  == $dataPengaduan->status) ? 'selected' : ''; 
                        @endphp
                            <option value="{{ $status }}" {{ $cek }}>{{ $status }}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="col-md-12 mt-3">
                    <label for="keterangan" class="form-label">Deskripsi Tanggapan</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" cols="50" rows="5">{{ old('keterangan') }}</textarea>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary  mt-4">Simpan</button>
                    <a href="{{url('/data_pengaduan')}}" class="btn btn-secondary mt-4">Batal</a>
                </div>
              </form>
            </div>
          </div>
    </div>
</div>

@endsection