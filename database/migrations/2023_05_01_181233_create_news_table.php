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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique()->comment('Заголовок новости');
            $table->string('description')->comment('Краткое описание новости');
            $table->string('body')->comment('Текст статьи');
            $table->string('author')->comment('Автор статьи');
            $table->timestamp('published_at')->nullable()->comment('Дата публикации статьи');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
