<?php

namespace App\Models;

use App\Models\User;
use App\Models\Pengaduan_masyarakat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tanggapan extends Model
{
    use HasFactory;
    protected $table = 'tanggapan';
    protected $fillable = ['tgl_tanggapan','keterangan'];
    
    public function pengaduan_masyarakat(): BelongsTo
    {
        return $this->belongsTo(Pengaduan_masyarakat::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
