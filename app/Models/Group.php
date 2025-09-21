<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'groups';

    protected $fillable = [
        'paket_id',
        'tanggal',
        'bulan',
        'tahun',
        'keterangan',
        'total_seat',
        'vendor',
        'tour_leader',
    ];

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }

    public function jamaahs()
    {
        return $this->hasMany(Jamaah::class);
    }
}



