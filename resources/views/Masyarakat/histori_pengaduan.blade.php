@extends('layout_masyarakat.index')
@section('content')
@include('sweetalert::alert')

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
                        <li class="breadcrumb-item active" aria-current="page">Pengaduan</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        @if($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
       @endif
       @if($message = Session::get('error'))
           <div class="alert alert-danger">
               <p>{{ $message }}</p>
           </div>
       @endif
       
        <h6 class="mb-0 text-uppercase">Histori Pengaduan</h6>
        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr align="center">
                              <th>No</th>
                              <th>Nama</th>
                              <th>Pengaduan</th>
                              <th>Tanggal Pengaduan</th>
                              <th>Alamat Pengaduan</th>
                              <th>Foto</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @foreach($historiPengaduan as $histori)
                            <tr>
                              <td>{{ $no++ }}</td>
                              <td>{{ $histori->nama }}</td>
                              <td>{{ $histori->nama_pengaduan }}</td>
                              <td>{{ \Carbon\Carbon::parse($histori->tgl_pengaduan)->format('l, d M Y') }}</td>
                              <td>{{ $histori->lokasi_pengaduan }}</td>
                              <td align="center">
                                <img src="{{ asset('assets/img/pengaduan/' . $histori->foto_pengaduan) }}" width="30%" />
                              </td>
                              <td align="center">
                                @if($histori->status == "Belum diproses")
                                <span class="badge rounded-pill bg-danger"> {{ $histori->status }}</span>
                                @endif
                                @if($histori->status == "Proses")
                                <span class="badge rounded-pill bg-warning"> {{ $histori->status }}</span>
                                @endif
                                @if($histori->status == "Selesai")
                                <span class="badge rounded-pill bg-success"> {{ $histori->status }}</span>
                                @endif
                               </td>
                              <td align="center">
                                <a class="btn btn-info btn-sm" href="{{ route('histori.show', $histori->id) }}" title="Detail Pengaduan">
                                    <i class="bi bi-eye"></i>
                                </a>
                              </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection