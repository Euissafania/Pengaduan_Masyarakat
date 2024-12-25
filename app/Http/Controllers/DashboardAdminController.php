<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
// use Maatwebsite\Excel\Excel;
use App\Exports\PengaduanExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Models\Pengaduan_masyarakat;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;

class DashboardAdminController extends Controller
{
    public function index()
    {
       
        $ar_user =DB::table('masyarakat')
        ->join('users', 'users.id', '=', 'masyarakat.user_id')
        ->select('masyarakat.*','users.nama','users.role')
        ->where('users.role', 'masyarakat')
        ->count();
    
        $ar_pengaduan = Pengaduan_masyarakat::count();
        $ar_label =['Belum diproses','Proses','Selesai'];

        $stt_blm = Pengaduan_masyarakat::where('status', 'Belum diproses')->count();
        $stt_proses = Pengaduan_masyarakat::where('status', 'Proses')->count();
        $stt_selesai = Pengaduan_masyarakat::where('status', 'Selesai')->count();
        // $angkaBulan = $pengaduan_perbulan->pluck('month');

        function angkaKeNamaBulan($angkaBulan) {
            return Carbon::createFromDate(null, $angkaBulan, 1)->format('F');
        }
        
        $pengaduan_perbulan = DB::table('pengaduan_masyarakat')
            ->select(DB::raw('MONTH(tgl_pengaduan) as month'), DB::raw('YEAR(tgl_pengaduan) as year'), DB::raw('COUNT(*) as total'))
            ->groupBy(DB::raw('YEAR(tgl_pengaduan)'), DB::raw('MONTH(tgl_pengaduan)'))
            ->get();
        
        // Mengonversi hasil query
        $namaBulan = $pengaduan_perbulan->map(function ($item) {
            $item->month_name = angkaKeNamaBulan($item->month);
            return $item;
        });

        return view('Admin.dashboard_admin',compact('ar_user','ar_pengaduan','ar_label','stt_blm','stt_proses','stt_selesai','pengaduan_perbulan','namaBulan'));
    }

    public function export()
    {
        return Excel::download(new PengaduanExport,'Pengaduan.xlsx');
    }

    public function PengaduanPDF(){
        $dataPengaduan = DB::table('pengaduan_masyarakat')
        ->join('masyarakat', 'masyarakat.id', '=', 'pengaduan_masyarakat.masyarakat_id')
        ->join('users', 'users.id', '=', 'masyarakat.user_id')
        ->select('users.nama', 'masyarakat.user_id', 'pengaduan_masyarakat.*')
        ->get();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML(view('Admin.GeneratePDF',compact('dataPengaduan')));
        return $pdf->stream('Pengaduan.pdf');
    }

// fungsi notifikasi
    // public function Notifikasi()
    // {
    //     $dataPengaduan = DB::table('pengaduan_masyarakat')
    //     ->join('masyarakat', 'masyarakat.id', '=', 'pengaduan_masyarakat.masyarakat_id')
    //     ->join('users', 'users.id', '=', 'masyarakat.user_id')
    //     ->select('users.nama', 'masyarakat.foto', 'pengaduan_masyarakat.nama_pengaduan','pengaduan_masyarakat.status', 'pengaduan_masyarakat.foto_pengaduan')
    //     ->where('pengaduan_masyarakat.status', 'Belum diproses')
    //     ->get();
    //     View::share('dataPengaduan', $dataPengaduan);
    //      return view('layout_admin.navbar');
    //     // return view('layout_admin.navbar', compact('dataPengaduan'));
    // }
}
