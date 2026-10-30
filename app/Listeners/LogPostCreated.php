<?php

namespace App\Listeners;

use App\Events\PostCreated;
use Illuminate\Support\Facades\Log;

// Слушатель события PostCreated
class LogPostCreated
{
    public function handle(PostCreated $event): void
    {
        // Запись в лог
        Log::info('Опубликована новая статья: «'.$event->post->title.'» (автор: '.$event->post->author.')');

        // Flash-сообщение в сессию
        session()->flash('event', 'Событие PostCreated: статья «'.$event->post->title.'» успешно опубликована.');
    }
}
