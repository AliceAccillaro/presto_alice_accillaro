<?php

namespace App\Http\Controllers;

use App\Models\Article;

class RevisorController extends Controller
{
    public function index()
    {
        $article_to_check = Article::whereNull('is_accepted')->first();

        return view('revisor.index', compact('article_to_check'));
    }

    public function accept(Article $article)
    {
        $article->is_accepted = true;
        $article->save();

        return redirect()->route('revisor.index')->with('message', "Hai accettato l'articolo!");
    }

    public function reject(Article $article)
    {
        $article->is_accepted = false;
        $article->save();

        return redirect()->route('revisor.index')->with('message', "Hai rifiutato l'articolo!");
    }
}