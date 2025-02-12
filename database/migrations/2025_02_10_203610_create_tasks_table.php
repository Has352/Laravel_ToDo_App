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
            $table->string('titel');
            $table->string('description')->nullable();
            $table->boolean('completed')->default(false);
            $table->foreignId('todo_list_id')->constrained('to_do_lists')->onDelete('cascade'); // تأكد من وجود اسم الجدول هنا
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
