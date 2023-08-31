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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('address');
            $table->unsignedBigInteger('regencies_id');
            $table->unsignedBigInteger('day_id');
            $table->text('notes')->nullable();
            $table->string('range')->nullable();
            $table->string('rider')->nullable();
            $table->string('route')->nullable();
            $table->timestamps();

            $table->foreign('regencies_id')->references('id')->on('regencies')->onDelete('cascade');
            $table->foreign('day_id')->references('id')->on('days')->onDelete('cascade');
        });

        Schema::create('pesanan_flower', function (Blueprint $table) {
            $table->unsignedBigInteger('pesanan_id');
            $table->unsignedBigInteger('flower_id');
            $table->unsignedBigInteger('additional_flower_id')->nullable(); // Ubah nama kolom ini
            $table->integer('total')->unsigned();
            $table->timestamps();
        
            $table->foreign('pesanan_id')->references('id')->on('pesanan')->onDelete('cascade');
            $table->foreign('flower_id')->references('id')->on('flowers')->onDelete('cascade');
            $table->foreign('additional_flower_id')->references('id')->on('flowers')->onDelete('cascade'); // Tambahkan foreign key untuk additional_flower_id
        
            $table->primary(['pesanan_id', 'flower_id']);
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanan_flower');
        Schema::dropIfExists('pesanan');
    }
};
