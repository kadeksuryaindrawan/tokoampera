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
            $table->foreignId('customer_id');
            $table->string('invoice');
            $table->string('total_sebelum_discount');
            $table->string('total');
            $table->string('status');
            $table->text('alamat');
            $table->string('long');
            $table->string('lat');
            $table->string('voucher');
            $table->string('type_voucher');
            $table->string('discount');
            $table->string('shipping_courier');
            $table->string('shipping_price');
            $table->string('nama_bank');
            $table->string('no_bank');
            $table->string('pemilik_bank');
            $table->text('bukti_bayar');
            $table->datetime('tanggal_bayar');
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
