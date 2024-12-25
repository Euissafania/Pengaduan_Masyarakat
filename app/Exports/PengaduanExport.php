<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use App\Models\Pengaduan_masyarakat;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;


class PengaduanExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $arr_pengaduan = DB::table('pengaduan_masyarakat')
        ->join('masyarakat', 'masyarakat.id', '=', 'pengaduan_masyarakat.masyarakat_id')
        ->join('users', 'users.id', '=', 'masyarakat.user_id')
        ->select('users.nama','pengaduan_masyarakat.tgl_pengaduan','pengaduan_masyarakat.nama_pengaduan',
                'pengaduan_masyarakat.tgl_pengaduan','pengaduan_masyarakat.deskripsi','pengaduan_masyarakat.lokasi_pengaduan',
                'pengaduan_masyarakat.foto_pengaduan','pengaduan_masyarakat.status')
        ->get();
        return $arr_pengaduan;
    }

    public function headings(): array
    {
        return ['Nama Masyarakat','tgl_pengaduan','Pengaduan','deskripsi','lokasi_pengaduan','foto_pengaduan','status'];
    }
        
}
