<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nominal',
        'status',
        'deskripsi',
        'gambar_voucher',
    ];
}
