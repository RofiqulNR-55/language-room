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
    Schema::create('pakets', function (Blueprint $table) {
    $table->id();
    $table->string('nama');
    $table->text('deskripsi')->nullable();
    $table->integer('harga');
    $table->string('kategori'); // contoh: SD, SMP, SMA
    $table->enum('tipe', ['online', 'offline']); // contoh: online / offline
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
        Schema::dropIfExists('pakets');
    }
};
