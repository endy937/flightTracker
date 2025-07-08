<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsbData extends Model
{
    use HasFactory;

    protected $table = 'adsb_data';

    // ✅ Tambahkan ini untuk nonaktifkan timestamps
    public $timestamps = false;

    protected $fillable = [
        'callsign',
        'lat',
        'lon',
        'altitude',
        'speed',
        'heading',
    ];
}
