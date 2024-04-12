<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable();
            $table->string('invoice');
            $table->double('total_sebelum_discount');
            $table->double('total');
            $table->enum('status', ['pending', 'menunggu pembayaran', 'konfirmasi pembayaran', 'terbayar', 'terkirim', 'diterima', 'ditolak']);
            $table->text('alamat')->nullable();
            $table->string('long')->nullable();
            $table->string('lat')->nullable();
            $table->string('voucher')->nullable();
            $table->double('discount')->nullable();
            $table->string('shipping_courier')->nullable();
            $table->double('shipping_price')->nullable();
            $table->string('nama_bank')->nullable();
            $table->string('no_bank')->nullable();
            $table->string('pemilik_bank')->nullable();
            $table->text('bukti_bayar')->nullable();
            $table->datetime('tanggal_bayar')->nullable();
            $table->text('catatan')->nullable();
            $table->text('resi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
