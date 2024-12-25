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
                        <li class="breadcrumb-item active" aria-current="page">Data User</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

      <div class="row">
        <div class="col">
            <h5 class="mt-2 text-uppercase" >Data User</h5>
        </div>
  </div>
  <hr/>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr align="center">
                              <th>No</th>
                              <th>Nama</th>
                              <th>Email</th>
                              <th>NIK</th>
                              <th>No.Telepon</th>
                              <th>Gender</th>
                              <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @foreach($data_user as $listUser)
                            @if($listUser->role == 'masyarakat') 
                            <tr align="center">
                              <td>{{ $no++ }}</td>
                              <td>{{ $listUser->nama }}</td>
                              <td>{{ $listUser->email}}</td>
                              <td>{{ $listUser->nik }}</td>
                              <td>{{ $listUser->no_telepon }}</td>
                              <td>{{ $listUser->gender }}</td>
                              <td>{{ $listUser->alamat }}</td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection