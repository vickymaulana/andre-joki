<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProgramBantuan extends Model
{
    use HasFactory;

    protected $table = 'program_bantuan';

    protected $fillable = ['nama_program', 'tahun', 'kuota'];

    public function warga(): BelongsToMany
    {
        return $this->belongsToMany(Warga::class, 'penerima_bantuan', 'program_id', 'warga_id')
            ->using(PenerimaBantuan::class)
            ->withPivot(['tanggal_terima', 'status_verifikasi'])
            ->withTimestamps();
    }

    public function penerimaBantuan(): HasMany
    {
        return $this->hasMany(PenerimaBantuan::class, 'program_id');
    }
}
