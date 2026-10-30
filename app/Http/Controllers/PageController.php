<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    // Страница «О проекте»: считаем посещения в сессии
    public function about(Request $request): View
    {
        $visits = $request->session()->get('about_visits', 0) + 1;
        $request->session()->put('about_visits', $visits);

        return view('pages.about', [
            'visits' => $visits,
        ]);
    }
}
