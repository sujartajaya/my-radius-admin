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
        Schema::create('guestusers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('username');
            $table->string('password');
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->integer('time_limit')->nullable();
            $table->string('rate_limit')->nullable();
            $table->datetime('expire')->nullable();
            $table->string('byte_limit')->nullable();
            $table->integer('share_limit')->default(1);
            $table->string('user_profile')->nullable();
            $table->string('user_group')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guestusers');
    }
};
