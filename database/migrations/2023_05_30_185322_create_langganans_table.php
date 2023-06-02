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
        Schema::create('langganan', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('address');
            $table->unsignedBigInteger('regencies_id');
            $table->unsignedBigInteger('day_id');
            $table->text('notes')->nullable();
            $table->text('pic')->nullable();
            $table->timestamps();

            $table->foreign('regencies_id')->references('id')->on('regencies')->onDelete('cascade');
            $table->foreign('day_id')->references('id')->on('days')->onDelete('cascade');
        });

        Schema::create('langganan_flower', function (Blueprint $table) {
            $table->unsignedBigInteger('langganan_id');
            $table->unsignedBigInteger('flower_id');
            $table->integer('total')->unsigned();
            $table->timestamps();

            $table->foreign('langganan_id')->references('id')->on('langganan')->onDelete('cascade');
            $table->foreign('flower_id')->references('id')->on('flowers')->onDelete('cascade');

            $table->primary(['langganan_id', 'flower_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('langganan_flower');
        Schema::dropIfExists('langganan');
    }
};
