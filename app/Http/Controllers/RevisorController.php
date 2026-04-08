<?php

namespace App\Http\Controllers;

use App\Mail\BecomeRevisor;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RevisorController extends Controller
{
    public function index()
    {
        $article_to_check = Article::whereNull('is_accepted')
            ->orderBy('created_at', 'asc')
            ->first();

        return view('revisor.index', compact('article_to_check'));
    }

    public function accept(Article $article)
    {
        $article->is_accepted = true;
        $article->save();

        session()->put('last_article_id', $article->id);

        return redirect()->back()->with('message', 'Articolo accettato con successo.');
    }

    public function reject(Article $article)
    {
        $article->is_accepted = false;
        $article->save();

        session()->put('last_article_id', $article->id);

        return redirect()->back()->with('message', 'Articolo rifiutato con successo.');
    }

    public function workWithUs()
    {
        return view('revisor.work-with-us');
    }

    public function sendRevisorRequest(Request $request)
    {
        $request->validate([
            'message' => 'required|min:10|max:1000',
        ]);

        Mail::to('admin@presto.it')->send(
            new BecomeRevisor(Auth::user(), $request->message)
        );

        return redirect()->route('work.with.us')
            ->with('message', 'Richiesta inviata con successo.');
    }

    public function undoLastAction()
    {
        $articleId = session('last_article_id');

        if (!$articleId) {
            return redirect()->back()->with('error', 'Nessuna operazione da annullare.');
        }

        $article = Article::find($articleId);

        if (!$article) {
            return redirect()->back()->with('error', 'Articolo non trovato.');
        }

        $article->is_accepted = null;
        $article->save();

        session()->forget('last_article_id');

        return redirect()->back()->with('message', 'Ultima operazione annullata con successo.');
    }
}