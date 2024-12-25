@extends('layout_masyarakat.index')
@section('content')
<div class="page-wrapper">
    <div class="page-content">
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-2 justify-content-center">
    <div class="col">
        <div class="card border-primary border-bottom border-3 border-0">
            @empty($dataPengaduan->foto_pengaduan)
            <img src="{{ asset('assets/images/gallery/01.png')}}" class="card-img-top" alt="...">     
            @else
            <img src="{{ asset('assets/img/pengaduan/'. $dataPengaduan->foto_pengaduan) }}" alt="{{ $dataPengaduan->nama_pengaduan }}"class="img-fluid rounded-start" />
            @endempty 
            <div class="card-body">
                <h4 class="card-title">Data Pengaduan Fasilitas</h4>
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
                        <td>{{ \Carbon\Carbon::parse($dataPengaduan->tgl_pengaduan)->format('l, d F Y') }}</td>
                        </tr>
                        <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>{{ $dataPengaduan->status}}</td>
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
                        <td>{{ \Carbon\Carbon::parse($dataTanggapan->tgl_tanggapan)->format('l, d F Y') }}</td>
                        </tr>
                        <tr>  
                        <td>Keterangan</td>
                        <td>:</td>
                        <td>{{$dataTanggapan->keterangan }}</td>
                        </tr>
                        @endif  
                    </tbody>
                 </table> 
                <hr>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ url('/histori_pengaduan') }}" class="btn btn-primary"><i class="bi bi-chevron-double-left"></i>Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection