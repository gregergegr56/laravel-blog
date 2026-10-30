<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Заполняем таблицу статей тестовыми данными.
     */
    public function run(): void
    {
        Post::create([
            'title' => 'Привет, мир!',
            'body' => 'Это моя первая статья в блоге.',
            'author' => 'Студент',
        ]);

        Post::create([
            'title' => 'Вторая статья',
            'body' => 'Здесь будет какой-нибудь текст.',
            'author' => 'Студент',
        ]);

        Post::create([
            'title' => 'Новость дня',
            'body' => 'Сегодня хороший день, ничего особенного не произошло.',
            'author' => 'Студент',
        ]);
    }
}
