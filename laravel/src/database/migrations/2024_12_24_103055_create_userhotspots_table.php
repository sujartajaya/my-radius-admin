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
        Schema::create('userhotspots', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->text('address')->nullable();
            $table->string('department');
            $table->string('phone');
            //$table->enum('time_limit',[true,false])->default(true);
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
        Schema::dropIfExists('userhotspots');
    }
};
