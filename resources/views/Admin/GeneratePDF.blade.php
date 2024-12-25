
<h3 align="center">Data Pengaduan</h3>
<hr>
<br><br>
        <table  border="1" align="center" cellpadding="10" cellspacing="0">
            <thead>
                <tr align="center" bgcolor="#6DB9EF">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Pengaduan</th>
                    <th>Tanggal Pengaduan</th>
                    <th>Alamat Pengaduan</th>
                    <th>Foto</th>
                    <th>Status</th>
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
                    <td>{{ $histori->tgl_pengaduan }}</td>
                    <td>{{ $histori->lokasi_pengaduan }}</td>
                    <td >
                    <img src="assets/img/pengaduan/{{ $histori->foto_pengaduan }}" width="40%" />
                    </td>
                    <td>{{ $histori->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        

