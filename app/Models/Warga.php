<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Warga extends Model
{
    use HasFactory;

    protected $table = 'warga';

    protected $fillable = ['nik', 'nama', 'alamat', 'desa_id'];

    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class, 'desa_id');
    }

    public function programBantuan(): BelongsToMany
    {
        return $this->belongsToMany(ProgramBantuan::class, 'penerima_bantuan', 'warga_id', 'program_id')
            ->using(PenerimaBantuan::class)
            ->withPivot(['tanggal_terima', 'status_verifikasi'])
            ->withTimestamps();
    }

    public function penerimaBantuan(): HasMany
    {
        return $this->hasMany(PenerimaBantuan::class, 'warga_id');
    }
}
