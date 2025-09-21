<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jamaah extends Model
{
    use HasFactory;

    protected $table = 'jamaah';

    protected $fillable = [
        'nama',
        'alamat',
        'kantor_id',
        'tanggal_lahir',
        'nomor_wa',
        'group_id',
        'vaksin_meningitis',
        'vaksin_polio',
        'passport',
        'status_pembayaran',
    ];

    public function kantor()
    {
        return $this->belongsTo(Kantor::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }
}