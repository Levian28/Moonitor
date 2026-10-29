<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pin_resets', function (Blueprint $table) {
            $table->string('email')->primary();   // satu token aktif per email
            $table->string('token');              // disimpan sebagai hash
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pin_resets');
    }
};
