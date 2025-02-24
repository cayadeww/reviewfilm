<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kategori', function (Blueprint $table) {
            $table->id();
            $table->string('kategori');
            $table->timestamps();
        });
        Schema::create('genre', function (Blueprint $table) {
            $table->id();
            $table->string('nama_genre');
            $table->timestamps();
        });
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('sinopsis');
            $table->string('url_trailer')->nullable();
            $table->integer('tahun_rilis');
            $table->integer('durasi');
            $table->string('sutradara');
            $table->string('gambar')->nullable();
            $table->foreignId('id_genre')->constrained('genre')->onDelete('cascade');
            $table->foreignId('id_kategori')->constrained('kategori')->onDelete('cascade');
            $table->bigInteger('id_users')->unsigned();

            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps(); 
        });
        
        Schema::create('rating', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_film')->constrained('films')->onDelete('cascade');
            $table->foreignId('id_users')->constrained('users')->onDelete('cascade');
            $table->enum('rating', ['1', '2', '3', '4', '5'])->comment('Rating dari 1-5');
            $table->timestamps();
        });

        Schema::create('komens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_film')->constrained('films')->onDelete('cascade');
            $table->foreignId('id_users')->constrained('users')->onDelete('cascade');
            $table->text('komen');
            $table->timestamps();
        });
        Schema::create('film_pemeran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_film')->constrained('films')->onDelete('cascade');
            $table->string('nama');
            $table->string('pemeran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('film_pemeran');
        Schema::dropIfExists('komen');
        Schema::dropIfExists('rating');
        Schema::dropIfExists('films');
        Schema::dropIfExists('genre');
        Schema::dropIfExists('kategori');
        Schema::dropIfExists('film_genre');
    }
};
