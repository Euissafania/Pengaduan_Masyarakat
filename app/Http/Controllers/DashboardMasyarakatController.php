<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\masyarakat;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengaduan_masyarakat;

class DashboardMasyarakatController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $ar_label =['Belum diproses','Proses','Selesai'];
        $ar_pengaduan =DB::table('pengaduan_masyarakat')
        ->join('masyarakat', 'masyarakat.id', '=', 'pengaduan_masyarakat.masyarakat_id')
        ->select('pengaduan_masyarakat.*')
        ->where('masyarakat.user_id', $user_id)
        ->count();
        $stt_blm =DB::table('pengaduan_masyarakat')
        ->join('masyarakat', 'masyarakat.id', '=', 'pengaduan_masyarakat.masyarakat_id')
        ->select('pengaduan_masyarakat.*')
        ->where('masyarakat.user_id', $user_id)
        ->where('pengaduan_masyarakat.status', 'Belum diproses') 
        ->count();
        $stt_proses =DB::table('pengaduan_masyarakat')
        ->join('masyarakat', 'masyarakat.id', '=', 'pengaduan_masyarakat.masyarakat_id')
        ->select('pengaduan_masyarakat.*')
        ->where('masyarakat.user_id', $user_id)
        ->where('pengaduan_masyarakat.status', 'Proses') 
        ->count();
        $stt_selesai =DB::table('pengaduan_masyarakat')
        ->join('masyarakat', 'masyarakat.id', '=', 'pengaduan_masyarakat.masyarakat_id')
        ->select('pengaduan_masyarakat.*')
        ->where('masyarakat.user_id', $user_id)
        ->where('pengaduan_masyarakat.status', 'Selesai') 
        ->count();
        $dataTanggapan = DB::table('tanggapan')
        ->join('pengaduan_masyarakat','pengaduan_masyarakat.id','=','tanggapan.pengaduan_id')
        ->join('masyarakat', 'masyarakat.id', '=', 'pengaduan_masyarakat.masyarakat_id')  
        ->select('pengaduan_masyarakat.*')
        ->where('masyarakat.user_id', $user_id)
        ->count();

        //  var_dump($stt_blm);
        //  die;
        return view('Masyarakat.dashboard_masyarakat', compact('ar_pengaduan','stt_blm','stt_proses','stt_selesai','ar_label','dataTanggapan'));

    }
    public function profile(){
        $user = Auth::user();
        $idlogin = $user->id;
        $profile =DB::table('masyarakat')
        ->join('users', 'users.id', '=', 'masyarakat.user_id')
        ->select('users.*','masyarakat.id as masyarakat_id','masyarakat.user_id','masyarakat.nik','masyarakat.no_telepon',
        'masyarakat.alamat','masyarakat.gender','masyarakat.foto')
        ->where('users.id', $idlogin)
        ->first();
        $arr_gender = ['Laki-Laki','Perempuan'];
        return view('Masyarakat.profile_masyarakat', compact('profile','arr_gender'));
    }

    public function update(Request $request, string $id)
    {

         DB::table('users')->where('id', $id)->update([
            'nama' => $request->input('nama'),
        ]);
         //------------ambil foto lama apabila user ingin ganti foto-----------
         $foto = DB::table('masyarakat')->select('foto')->where('user_id',$id)->get();
         foreach($foto as $f){
             $namaFileFotoLama = $f->foto;
         }
         //------------apakah user  ingin ubah upload foto baru-----------
         if(!empty($request->foto)){
             //jika ada foto lama, hapus foto lamanya terlebih dahulu
             if(!empty($namaFileFotoLama)) unlink('assets/img/profile/'.$namaFileFotoLama);
             //lalukan proses ubah foto lama menjadi foto baru
             $nama = Str::random(20);
             $extensi = $request->foto->extension();
             $fileName =  $nama . '.' .  $extensi;
             //$fileName = $request->foto->getClientOriginalName();
             $request->foto->move(public_path('assets/img/profile/'),$fileName);
         }
         else{
             $fileName = $namaFileFotoLama;
         }
        
        DB::table('masyarakat')->where('user_id',$id)->update(
        [
            'nik' => $request->input('nik'),
            'no_telepon' => $request->input('no_telepon'),
            'alamat' => $request->input('alamat'),
            'gender' => $request->input('gender'),
            'foto'=>$fileName,
        ]);
        return redirect('/histori_pengaduan')->with('success','Data Profile Berhasil Diubah');
        
    }
    public function apiMasyarakat(){
        $masyarakat = Masyarakat::all();
        return response()->json(
            [
                'success' => true,
                'message' => 'Data masyarakat berhasil di ambil',
                'data' => $masyarakat

            ], 200);
        }
        public function apiMasyarakatDetail($id){
            $masyarakat = Masyarakat::find($id);
            if($masyarakat){
                return response()->json(
                    [
                        'success' => true,
                        'message' => 'Data Detail masyarakat berhasil tampil',
                        'data' => $masyarakat
                    
                ], 200);
            }
            else{
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Data Detail masyarakat tidak ditemukan',
                        'data' => $masyarakat
                    ],404);
            }
        }
    }
