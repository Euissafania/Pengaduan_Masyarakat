<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamProject extends Controller
{
  public function index(){
    $rows = Team::all();
    
    return view('Landingpage.home',compact('rows'));
  }
}
