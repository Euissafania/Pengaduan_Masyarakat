<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class SesiController extends Controller
{
  function index()
  {
    return view('login-register.signin');
  }

  function login(Request $request){
    $request->validate(
    [
      'email' => 'required',
      'password' => 'required'
    ],
    [
      'email.required' => 'Email wajib diisi',
      'password.required' => 'Password wajib diisi'
    ]);

    $infologin = [
      'email' => $request->email,
      'password' => $request->password,
    ];

    if (Auth::attempt($infologin)) {
      if (Auth::user()->role == 'admin'){
        Alert::success('Login Berhasil!', 'Selamat datang ');
        return redirect()->route('dashboard_admin');
      }
      elseif (Auth::user()->role == 'masyarakat'){
        Alert::success('Login Berhasil!', 'Selamat datang ');
        return redirect()->route('dashboard_masyarakat');
      }
    } else {
      return redirect('/signin')->withErrors('Username atau Password yang dimasukkan tidak sesuai');
    }
  }

  function logout() {
    auth::logout();
    Alert::success('Anda telah logout');
    return redirect('');
  }
}
