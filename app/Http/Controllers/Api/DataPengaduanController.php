<?php

namespace App\Http\Controllers\Api;


use App\Models\masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataPengaduanResource;
use App\Models\Pengaduan_masyarakat;
use Illuminate\Support\Facades\Validator;



class DataPengaduanController extends Controller
{
    // Menampilkan Semua data
    public function index()
    {
        $dataPengaduan = DB::table('pengaduan_masyarakat')
        ->leftJoin('tanggapan', 'pengaduan_masyarakat.id', '=', 'tanggapan.pengaduan_id')
        ->join('masyarakat', 'masyarakat.id', '=', 'pengaduan_masyarakat.masyarakat_id')
        ->join('users', 'users.id', '=', 'masyarakat.user_id')
        ->select('pengaduan_masyarakat.id as id_pengaduan',
            'users.nama',
            'pengaduan_masyarakat.nama_pengaduan',
            'pengaduan_masyarakat.tgl_pengaduan',
            'pengaduan_masyarakat.deskripsi',
            'pengaduan_masyarakat.lokasi_pengaduan',
            'pengaduan_masyarakat.status',
            'tanggapan.tgl_tanggapan',
            'tanggapan.keterangan'
        )
        ->orderBy('tanggapan.tgl_tanggapan', 'desc')
        ->distinct()
        ->get();

        if($dataPengaduan)
        {
            return response()->json(
                [
                    'success'=>true,
                    'message'=>'Data Pengaduan',
                    'data'=> $dataPengaduan 
                ],200);
        }else{
            return response()->json(
                [
                    'success'=>false,
                    'message'=>'Data Pengaduan Tidak Ditemukan',
                ],404);
        } 
        
        return new DataPengaduanResource(true,'Data Pengaduan', $dataPengaduan );
        
    }

  // Membuat atau create Data
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'nama_pengaduan' => 'required|max:60',
            'lokasi_pengaduan' => 'required',
            'deskripsi' => 'required',
        ]
        );
        //cek error atau tidak inputan data
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }

        $dataPengaduan= DB::table('pengaduan_masyarakat')->insert(
        [    
                'masyarakat_id'=>$request->input('masyarakat_id'),
                'nama_pengaduan'=>$request->nama_pengaduan,
                'tgl_pengaduan'=> now(),
                'deskripsi'=>$request->deskripsi,
                'lokasi_pengaduan'=>$request->lokasi_pengaduan,
                'foto_pengaduan'=>$request->foto_pengaduan,
                'status'=>'Belum diproses',
        ]);

        if($dataPengaduan){
            return response()->json(
                [
                    'success'=>true,
                    'message'=>'Data Berhasil Di Tambahkan',
                    'data' => $dataPengaduan
                ],200);
        }
        else{
            return response()->json(
                [
                    'success'=>false,
                    'message'=>'Data Pengaduan Tidak Ditemukan',
                ],404);
        } 

    }

//    Melihat Detail Data
    public function show($id)
    {
        $dataPengaduan = DB::table('pengaduan_masyarakat')
        ->leftJoin('tanggapan', 'pengaduan_masyarakat.id', '=', 'tanggapan.pengaduan_id')
        ->join('masyarakat', 'masyarakat.id', '=', 'pengaduan_masyarakat.masyarakat_id')
        ->join('users', 'users.id', '=', 'masyarakat.user_id')
        ->select('pengaduan_masyarakat.id as id_pengaduan',
            'users.nama',
            'pengaduan_masyarakat.nama_pengaduan',
            'pengaduan_masyarakat.tgl_pengaduan',
            'pengaduan_masyarakat.deskripsi',
            'pengaduan_masyarakat.lokasi_pengaduan',
            'pengaduan_masyarakat.status',
            'tanggapan.tgl_tanggapan',
            'tanggapan.keterangan'
        )
        ->where('pengaduan_masyarakat.id', $id)
        ->first();


       if($dataPengaduan){
            return response()->json(
                [
                    'success'=>true,
                    'message'=>'Data Detail Pengaduan',
                    'data'=> $dataPengaduan 
                ],200);
        }
        else{
            return response()->json(
                [
                    'success'=>false,
                    'message'=>'Data Pengaduan Tidak Ditemukan',
                ],404);
        } 
        
            return new DataPengaduanResource(true,'Data Detail Pengaduan',$dataPengaduan );
    }

// Mengupdate Data
    public function update(Request $request, string $id)
    {
        $dataPengaduans = DB::table('pengaduan_masyarakat')
        ->where('id', $id)
        ->update(['status' => $request->input('status')]);
        // Ngambial user_id
        $dataPengaduan = DB::table('pengaduan_masyarakat')
        ->join('masyarakat', 'masyarakat.id', '=', 'pengaduan_masyarakat.masyarakat_id')
        ->join('users', 'users.id', '=', 'masyarakat.user_id')
        ->select('masyarakat.user_id')
        ->where('pengaduan_masyarakat.id', $id)
        ->first();
        $user_id = $dataPengaduan->user_id;
        // Ngambil pengaduan_id
        $rs = Pengaduan_masyarakat::find($id);
        $pengaduan_id = $rs['id'];
        if ($request->input('keterangan')) {
        $dataTanggapan= DB::table('tanggapan')->insert(
            [    
                 'user_id'=>$user_id,
                 'pengaduan_id'=>$pengaduan_id,
                 'tgl_tanggapan'=> now(),
                 'keterangan'=> $request->input('keterangan'),
            ]);
        }

    //    Menampilkan data di postman
        $dataPengaduanx = DB::table('pengaduan_masyarakat')
        ->leftJoin('tanggapan', 'pengaduan_masyarakat.id', '=', 'tanggapan.pengaduan_id')
        ->join('masyarakat', 'masyarakat.id', '=', 'pengaduan_masyarakat.masyarakat_id')
        ->join('users', 'users.id', '=', 'masyarakat.user_id')
        ->select('pengaduan_masyarakat.id as id_pengaduan',
            'users.nama',
            'pengaduan_masyarakat.nama_pengaduan',
            'pengaduan_masyarakat.tgl_pengaduan',
            'pengaduan_masyarakat.deskripsi',
            'pengaduan_masyarakat.lokasi_pengaduan',
            'pengaduan_masyarakat.status',
            'tanggapan.tgl_tanggapan',
            'tanggapan.keterangan'
        )
        ->where('pengaduan_masyarakat.id', $id)
        ->first();
        if($dataPengaduans ||  $dataTanggapan){
            return response()->json(
                [
                    'success'=>true,
                    'message'=>'Data Berhasil Di ubah',
                    'data' => $dataPengaduanx
                ],200);
        }
        else{
            return response()->json(
                [
                    'success'=>false,
                    'message'=>'Data Pengaduan Tidak Ditemukan',
                ],404);
        } 
       
        return new DataPengaduanResource(true, 'Data Berhasil diubah',$dataPengaduanx);
    }


// Menghapus data
    public function destroy($id)
    {
        $dataPengaduan =Pengaduan_masyarakat::find($id);
        if (!empty( $dataPengaduan ->foto_pengaduan)) {
            unlink(public_path('assets/img/pengaduan/' .  $dataPengaduan->foto_pengaduan));
         }
        if ($dataPengaduan) {
            // Hapus tanggapan terkait sebelum menghapus data pengaduan
            DB::table('tanggapan')->where('pengaduan_id', $id)->delete();
            $dataPengaduan->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Data Pengaduan berhasil dihapus',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data Pengaduan tidak ditemukan',
            ], 404);
        }
    }
}

