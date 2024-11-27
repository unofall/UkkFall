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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->integer('percentage')->default(0)->nullable();
            $table->foreignId('task_idtasks')->nullable()->constrained('tasks')->cascadeOnDelete()->cascadeOnUpdate();
            // $table->enum('status',['proses','selesai'])->nullable()->default('proses');
            $table->foreignId('events_id')->constrained('events')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('users_id')->nullable()->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
