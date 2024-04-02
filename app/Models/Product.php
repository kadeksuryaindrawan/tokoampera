<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'nama_produk',
        'deskripsi',
        'price',
        'status',
        'img',
        'stok',
        'rated',
    ];
}
