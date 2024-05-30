<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasiensTable extends Migration
{
    public function up()
    {
        Schema::create('pasiens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->string('umur')->nullable();
            $table->string('alamat')->nullable();
            $table->string('penyakit')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
