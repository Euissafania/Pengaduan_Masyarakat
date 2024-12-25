<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
  public function run(): void
  {
    $dataTeam = [
      [
        'nama' => 'Hadi Prasetiyo',
        'role' => 'Project Manager',
        'program_studi' => 'Sistem Informasi',
        'kampus' => 'Universitas Mulawarman',
        'foto' => 'hadiiyok.jpg',
        'facebook' => 'hadi.prasetiyo.76',
        'github' => 'hadiprasetiyo',
        'instagram' => 'hadiiprasetiyo',
        'discord' => 'hadiiyok#7878',
        'linkedin' => 'hadiprasetiyo' 
      ],
      [
        'nama' => 'Euis Safania',
        'role' => 'Backend',
        'program_studi' => 'Teknik Informatika',
        'kampus' => 'Universitas Negeri Semarang',
        'foto' => 'euis.jpg',
        'facebook' => '#',
        'github' => 'euissafani',
        'instagram' => 'safania.euis',
        'discord' => '#',
        'linkedin' => 'euis-safania-083023262' 
      ],
      [
        'nama' => 'Zian Naisila A',
        'role' => 'Frontend',
        'program_studi' => 'Sistem Informasi',
        'kampus' => 'STMIK - IM Bandung',
        'foto' => 'zian.png',
        'facebook' => 'Ziannaisilaa',
        'github' => 'Ziannaisilaa',
        'instagram' => 'ziannaisilaa',
        'discord' => '#',
        'linkedin' => 'ziannaisilaa' 
      ],
      [
        'nama' => 'Riski Eggy Saputro',
        'role' => 'Database Management',
        'program_studi' => 'Teknik Informatika',
        'kampus' => 'Universitas Banten Jaya',
        'foto' => 'eggy.jpeg',
        'facebook' => '#',
        'github' => 'RES27',
        'instagram' => 'eggy_riski1',
        'discord' => '#',
        'linkedin' => '#' 
      ]
    ];
    // menggunakan query builder
    foreach ($dataTeam as $teamMember) {
      DB::table('teamproject')->insert([
        'nama' => $teamMember['nama'],
        'role' => $teamMember['role'],
        'program_studi' => $teamMember['program_studi'],
        'kampus' => $teamMember['kampus'],
        'foto' => $teamMember['foto'],
        'facebook' => $teamMember['facebook'],
        'github' => $teamMember['github'],
        'instagram' => $teamMember['instagram'],
        'discord' => $teamMember['discord'],
        'linkedin' => $teamMember['linkedin'],
      ]);
    }
  }
}
