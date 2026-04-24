<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PenerimaBantuan extends Pivot
{
    use HasFactory;

    protected $table = 'penerima_bantuan';

    public $incrementing = true;

    protected $fillable = [
        'warga_id',
        'program_id',
        'tanggal_terima',
        'status_verifikasi',
    ];

    protected $casts = [
        'tanggal_terima' => 'date',
    ];

    public function warga(): BelongsTo
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(ProgramBantuan::class, 'program_id');
    }
}
