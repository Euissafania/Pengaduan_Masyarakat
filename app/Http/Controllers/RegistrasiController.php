<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RegistrasiController extends Controller
{
  function Registrasi()
  {
    $arr_gender = ['Laki-Laki','Perempuan'];
    return view('login-register/daftar', compact('arr_gender'));
  }

  function createRegistrasi(Request $request)
  {
    $request->validate([
      'nama' => 'required',
      'email' => 'required|email|unique:users',
      'password' => 'required|min:6',
      'nik' => 'required|min:16',
      'no_telepon' => 'required|max:15',
      'alamat' => 'required',
      'gender' => 'required',

    ],[
      'nama.required' => 'Nama wajib diisi',
      'email.required' => 'Email wajib diisi',
      'email.email' => 'Silahkan masukkan email yang valid',
      'email.unique' => 'Email sudah pernah digunakan, silahkan pilih email yang lain',
      'password.required' => 'Password wajib diisi',
      'password.min' => 'Minimum password yang diizinkan adalah 6 karakter',
      'nik.required' => 'NIK wajib diisi',
      'nik.min' => 'NIK minimal 16 karakter',
      'no_telepon.required' => 'No Telepon wajib diisi',
      'no_telepon.min' => 'No Telepon maksimal 15 karakter',
      'alamat.required' => 'Alamat wajib diisi',
      'gender.required' => 'Jenis Kelamin wajib diisi',
    ]);

   
    $user = User::create([
      'id' => $request->input('id'),
      'nama'=>$request->nama,
      'email'=>$request->email,
      'password'=>$request->password
    ]);
    // $user = User::create($data);
     
    // $id =DB::table('users')->insertGetId($data);
    if(!empty($request->foto)){
      $nama = Str::random(5);
      $extensi = $request->foto->extension();
      $fileName =  $nama . '.' .  $extensi;
      //$fileName = $request->foto->getClientOriginalName();
      $request->foto->move(public_path('assets/img/profile'),$fileName);
    }
    else{
        $fileName = '';
    }

    DB::table('masyarakat')->insert([
        'user_id' => $user->id,
        'nik'=>$request->nik,
        'no_telepon'=>$request->no_telepon,
        'alamat'=>$request->alamat,
        'gender'=>$request->gender,
        'foto'=>$fileName,
      ]);

    auth()->login($user);
    alert('Regitrasi Berhasil','Selamat Datang', 'success');
    return redirect()->to('/signin');
  }

  // API Data User (Lokal)
  function apiDataUser()
  {
    $users = User::all();
    return response()->json(
      [
        'success'=>true,
        'message'=>'Semua Data User',
        'data'=>$users
      ],200
    );
  }

  function apiDataUserId($id)
  {
    $user = User::find($id);
    if ($user) {
      return response()->json(
        [
          'success'=>true,
          'message'=>'Data User by id berhasil ditemukan',
          'data'=>$user
        ],200
      );
    } else {
      return response()->json(
        [
          'success'=>false,
          'message'=>'Data User tidak ditemukan',
          'data'=>$user
        ],404
      );
    }
  }
}
