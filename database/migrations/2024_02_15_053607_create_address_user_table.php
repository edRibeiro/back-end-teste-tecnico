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
        Schema::create('address_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('address_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address_user');
    }
};
