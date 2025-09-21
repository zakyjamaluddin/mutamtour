<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'jamaah_id',
        'jenis',
        'jumlah',
        'keterangan',
    ];

    public function jamaah()
    {
        return $this->belongsTo(Jamaah::class);
    }
}