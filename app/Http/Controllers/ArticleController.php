<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    public function create()
    {
        return view('article.create');
    }

    public function index(Request $request)
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

        return view('article.index', compact('articles'));
    }

    public function show(Article $article)
    {
        $article->load(['category', 'user', 'images']);
        return view('article.show', compact('article'));
    }

    public function byCategory(Category $category, Request $request)
    {
        $articles = Article::with(['category', 'images'])
            ->where('is_accepted', true)
            ->where('category_id', $category->id)
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = trim($request->q);
                $words = preg_split('/\s+/', $search);

                foreach ($words as $word) {
                    $query->where(function ($q) use ($word) {
                        $q->where('title', 'like', "%{$word}%")
                            ->orWhere('description', 'like', "%{$word}%");
                    });
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(6)
            ->withQueryString();

        return view('article.byCategory', compact('category', 'articles'));
    }
}
