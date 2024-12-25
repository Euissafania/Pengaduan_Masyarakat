<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use RealRashid\SweetAlert\Facades\Alert;
// use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  function admin(){
    return redirect()->route('dashboard_admin');
  }
  function masyarakat(){
    
    return redirect()->route('dashboard_masyarakat');
  }
}
