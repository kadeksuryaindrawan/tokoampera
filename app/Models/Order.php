<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'invoice',
        'total_sebelum_discount',
        'total',
        'status',
        'alamat',
        'long',
        'lat',
        'voucher',
        'discount',
        'shipping_courier',
        'shipping_price',
        'nama_bank',
        'no_bank',
        'pemilik_bank',
        'bukti_bayar',
        'tanggal_bayar',
        'catatan',
        'resi'
    ];
}
