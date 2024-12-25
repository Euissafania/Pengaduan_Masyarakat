<?php

namespace App\Models;

use App\Http\Controllers\TeamProject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
  use HasFactory;
  
  protected $table = 'teamproject';
  protected $fillable =
  [
    'nama',
    'role',
    'program_studi',
    'kampus',
    'foto',
    'facebook',
    'github',
    'instagram',
    'discord',
    'linkedin' 
  ];
}
