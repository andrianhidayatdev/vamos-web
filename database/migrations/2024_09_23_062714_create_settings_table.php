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
        Schema::create('setting', function (Blueprint $table) {
            $table->id('id_setting');
            $table->text('alamat')->nullable();
            $table->string('telepon')->nullable();
            $table->tinyInteger('diskon')->nullable()->default(0);
            $table->text('logo')->nullable();
            $table->text('kartu_member')->nullable();
            $table->foreignId('id_cabang')->nullable()->constrained('cabang', 'id_cabang')->onDelete('set null')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting');
    }
};
