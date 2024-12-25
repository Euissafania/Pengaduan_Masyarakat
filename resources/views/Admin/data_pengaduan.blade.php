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
                        <li class="breadcrumb-item active" aria-current="page">Data Pengaduan</li>
                    </ol>
                </nav>
            </div>
        </div>
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
      <div class="row">
        <div class="col">
            <h5 class="mt-2 text-uppercase" >Data Pengaduan</h5>
        </div>
        <div class="col col-lg-1">
          <a href="{{ route('pengaduan-pdf') }}" class="btn btn-danger btn-sm" target="_blank" title="Export to PDF" style="white-space: nowrap;">
              <i class="bi bi-file-earmark-pdf"></i>PDF
          </a>
      </div>
      <div class="col col-lg-1">
          <a href="{{ url('/excel-export') }}" class="btn btn-success btn-sm" target="_blank" title="Export to Excel" style="white-space: nowrap;">
            <i class="bi bi-file-earmark-spreadsheet"></i>Excel</a>
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
                          @foreach($dataPengaduan as $histori)
                          <tr align="center">
                            <td>{{ $no++ }}</td>
                            <td>{{ $histori->nama }}</td>
                            <td>{{ $histori->nama_pengaduan }}</td>
                            <td>{{ \Carbon\Carbon::parse($histori->tgl_pengaduan)->format('l, d M Y')  }}</td>
                            <td>{{ $histori->lokasi_pengaduan }}</td>
                            <td >
                              <img src="{{ asset('assets/img/pengaduan/' . $histori->foto_pengaduan) }}" width="30%" />
                            </td>
                            <td>
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
                              <form method="POST" action="{{ route('delete', $histori->id) }}">
                                  @csrf
                                  @method('DELETE')
                                  <a class="btn btn-warning btn-sm" href="{{ route('show_data.show', $histori->id) }}" title="Ubah Data Pengajuan">
                                      <i class="bi bi-pencil-fill"></i>
                                  </a>
                                  @if($histori->status == "Selesai")
                                  <button type="submit" class="btn btn-danger btn-sm show-alert-delete-box" title="Hapus pengajuan">
                                      <i class="bi bi-trash"></i>
                                  </button>
                                  @endif
                                  @if($histori->status == "Belum diproses" || $histori->status == "Proses")
                                  <button type="submit" class="btn btn-danger btn-sm show-alert-delete-box" title="Hapus pengajuan" disabled>
                                      <i class="bi bi-trash"></i>
                                  </button>
                                  @endif
                              </form>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">
  $('.show-alert-delete-box').click(function (event) {
    var form = $(this).closest("form");
    event.preventDefault();
    swal({
      title: "Anda yakin data ini dihapus??",
      text: "Jika Anda menghapus , data akan hilang selamanya.",
      icon: "warning",
      type: "warning",
      buttons: ["Batal", "Hapus!"],
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, Hapus!'
    }).then((willDelete) => {
      if (willDelete) {
        $.ajax({
          type: form.attr('method'),
          url: form.attr('action'),
          data: form.serialize(),
          success: function (response) {
            swal({
              title: 'Berhasil!',
              text: 'Data berhasil dihapus.',
              icon: 'success'
            }).then(() => {
              location.reload();
            });
          },
          error: function (error) {
            console.log('Error:', error);
          }
        });
      }
    });
  });
</script>
@endsection