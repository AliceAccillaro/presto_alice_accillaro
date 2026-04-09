<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home(Request $request)
    {
        $articles = Article::with(['category', 'images'])
            ->where('is_accepted', true)
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = trim($request->q);
                $words = preg_split('/\s+/', $search);

                foreach ($words as $word) {
                    $query->where(function ($q) use ($word) {
                        $q->where('title', 'like', "%{$word}%")
                          ->orWhere('description', 'like', "%{$word}%")
                          ->orWhereHas('category', function ($categoryQuery) use ($word) {
                              $categoryQuery->where('name', 'like', "%{$word}%");
                          });
                    });
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(6)
            ->withQueryString();

        return view('home', compact('articles'));
    }

    public function setLanguage($lang)
    {
        if (!in_array($lang, ['it', 'en', 'es'])) {
            abort(400);
        }

        session(['locale' => $lang]);

        return redirect()->back();
    }
}
