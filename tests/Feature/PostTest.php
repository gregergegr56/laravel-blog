<?php

namespace Tests\Feature;

use App\Events\PostCreated;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    // Главная страница со списком статей
    public function test_index_page_shows_posts(): void
    {
        Post::create([
            'title' => 'Тестовая статья',
            'body' => 'Достаточно длинный текст статьи для прохождения валидации.',
            'author' => 'Студент',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Тестовая статья');
    }

    // Страница с POST-формой открывается
    public function test_create_form_page_loads(): void
    {
        $this->get('/posts/create')->assertStatus(200)->assertSee('Добавить статью');
    }

    // Корректные данные сохраняются, событие PostCreated генерируется
    public function test_valid_post_is_created_and_event_is_fired(): void
    {
        Event::fake([PostCreated::class]);

        $response = $this->post('/posts', [
            'title' => 'Новая статья',
            'body' => 'Это очень интересный текст новой статьи.',
            'author' => 'Студент',
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('posts', ['title' => 'Новая статья']);

        Event::assertDispatched(PostCreated::class, function (PostCreated $event) {
            return $event->post->title === 'Новая статья';
        });
    }

    // Невалидные данные отклоняются, статья в базу не попадает
    public function test_invalid_post_is_rejected(): void
    {
        $response = $this->post('/posts', [
            'title' => '',
            'body' => 'коротко',
        ]);

        $response->assertSessionHasErrors(['title', 'body']);
        $this->assertDatabaseCount('posts', 0);
    }

    // Избранное хранится в сессии
    public function test_favorite_is_stored_in_session(): void
    {
        $post = Post::create([
            'title' => 'Статья для избранного',
            'body' => 'Совсем обычный текст статьи для теста.',
            'author' => 'Студент',
        ]);

        // Первый клик — добавляем в избранное
        $this->post('/posts/'.$post->id.'/favorite')
            ->assertSessionHas('favorites', fn ($ids) => in_array($post->id, $ids));

        // Второй клик — убираем из избранного
        $this->from('/')->post('/posts/'.$post->id.'/favorite')
            ->assertSessionHas('favorites', fn ($ids) => ! in_array($post->id, $ids));
    }

    // Счётчик посещений страницы «О проекте» хранится в сессии
    public function test_about_page_counts_visits_in_session(): void
    {
        $this->get('/about')->assertSee('1 раз');
        $this->get('/about')->assertSee('2 раз');
    }
}
