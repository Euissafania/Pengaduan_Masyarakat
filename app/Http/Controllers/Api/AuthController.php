<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuthController extends Controller
{
  // REGISTER
  public function register(Request $request){

    $user = User::create([
      'id' => $request->input('id'),
      'nama'=>$request->nama,
      'email'=>$request->email,
      'password'=>$request->password
    ]);

    if (!empty($request->foto)) {
      $nama = Str::random(5);
      $extensi = $request->foto->extension();
      $fileName =  $nama . '.' .  $extensi;
      $request->foto->move(public_path('assets/img/profile'),$fileName);
    } else {
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

    return response()->json([
      'status' => 'success',
      'message' => 'register sukses'
    ]);
  }

  // LOGIN
  public function login(Request $request)
    {
      $input  = [
        "email" => $request->email,
        "password" => $request->password,
      ];

      $user = User::where("email", $input["email"])->first();

      if (Auth::attempt($input)) {
        $token = $user->createToken("token")->plainTextToken;

        return response()->json([
          "code" => 200,
          "status" => "success",
          "message" => "Login success",
          "token" => $token
        ]);
      } else {
        return response()->json([
            "code" => 401,
            "status" => "error",
            "message" => "Login failed"
        ]);
      }
    }
  }

