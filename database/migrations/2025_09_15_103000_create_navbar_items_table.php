<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
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

    public function down(): void
    {
        Schema::dropIfExists('navbar_items');
    }
};