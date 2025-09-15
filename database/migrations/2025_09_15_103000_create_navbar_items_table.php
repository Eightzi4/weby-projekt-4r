<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Ujistěte se, že název třídy odpovídá
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ujistěte se, že název tabulky je správný
        Schema::create('navbar_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('route');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('order')->default(0);
            $table->enum('align', ['left', 'right'])->default('left');
            $table->boolean('is_admin_item')->default(false);
            $table->boolean('requires_auth')->default(false);
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('navbar_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('navbar_items');
    }
};