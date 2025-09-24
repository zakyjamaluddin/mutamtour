<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('jamaah', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('alamat')->nullable();
            $table->foreignId('kantor_id')->constrained('kantor');
            $table->date('tanggal_lahir')->nullable();
            $table->string('nomor_wa')->nullable();
            $table->foreignId('group_id')->nullable()->constrained('groups');
            $table->boolean('vaksin_meningitis')->default(false);
            $table->boolean('vaksin_polio')->default(false);
            $table->boolean('passport')->default(false);
            $table->boolean('status_pembayaran')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jamaah');
    }
};





















