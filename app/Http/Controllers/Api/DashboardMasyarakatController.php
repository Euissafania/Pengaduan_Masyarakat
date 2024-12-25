<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Masyarakat;
use App\Http\Resources\MasyarakatResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class DashboardMasyarakatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $masyarakat = Masyarakat::all();
        return new MasyarakatResource(true,'Data Masyarakat',$masyarakat);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        
        // ...
        
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'nik' => 'required|min:16',
            'no_telepon' => 'required|max:15',
            'alamat' => 'required',
            'gender' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        
        // Create User
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        // Insert into Masyarakat table
        $masyarakat = DB::table('masyarakat')->insert([
            'user_id' => $user->id,
            'nik' => $request->nik,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
            'gender' => $request->gender,
        ]);
    
        return new MasyarakatResource(true, 'Data Masyarakat Berhasil Ditambahkan',$masyarakat);
    }
        

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $masyarakat = Masyarakat::find($id);
        if($masyarakat){
            return new MasyarakatResource(true,'Detail Masyarakat',$masyarakat);
        }
        else{
            return response()->json(
                [
                    'success'=>false,
                    'message'=>'Data Masyarakat Tidak Ditemukan',
                ],404);
        }    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      // Validation
      $validator = Validator::make($request->all(), [
          'nama' => 'required|string',
          'nik' => 'required|string',
          'no_telepon' => 'required|string',
          'alamat' => 'required|string',
          'gender' => 'required|string',
          // Add other validation rules as needed
      ]);
  
      // Check if validation fails
      if ($validator->fails()) {
          return response()->json(['error' => $validator->errors()], 400);
      }
  
      // Update 'users' table
      DB::table('users')->where('id', $id)->update([
          'nama' => $request->input('nama'),
      ]);
  
      // Update 'masyarakat' table
      $masyarakat = DB::table('masyarakat')->where('user_id', $id)->update([
          'nik' => $request->input('nik'),
          'no_telepon' => $request->input('no_telepon'),
          'alamat' => $request->input('alamat'),
          'gender' => $request->input('gender'),
      ]);
  
      // Return a JSON response with success message and updated data
      return response()->json([
          'success' => true,
          'message' => 'Data Masyarakat Berhasil diubah',
          'data' => $masyarakat,
      ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $masyarakat = Masyarakat::whereId($id)->first();
        $masyarakat->delete();
        return new MasyarakatResource(true, 'Data Masyarakat Berhasil dihapus',$masyarakat);
    }
}
