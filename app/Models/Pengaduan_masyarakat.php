<?php

namespace App\Models;

use App\Models\Tanggapan;
use App\Models\Masyarakat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pengaduan_masyarakat extends Model
{
    use HasFactory;
    protected $table = 'pengaduan_masyarakat';
    protected $fillable = ['masyarakat_id','nama_pengaduan','tgl_pengaduan','deskripsi','lokasi_pengaduan',
                           'status'];

    public function tanggapan(): HasMany
    {
        return $this->hasMany(Tanggapan::class);
    }
    public function masyarakat(): BelongsTo
    {
        return $this->belongsTo(Masyarakat::class);
    }
}
