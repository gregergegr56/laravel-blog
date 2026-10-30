<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Миграция таблицы статей блога.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');            // заголовок статьи
            $table->text('body');               // текст статьи
            $table->string('author')->default('Аноним'); // автор
            $table->timestamps();               // created_at / updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
