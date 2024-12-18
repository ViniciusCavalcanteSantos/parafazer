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
        Schema::create('todo_group', function (Blueprint $table) {
            $table->id("id");
            $table->foreignId("users_id")->references("id")->on("users")->onUpdate("cascade")->onDelete("cascade");
            $table->string("title", 80);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todo_group');
    }
};
