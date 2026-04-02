<?php

namespace App\Http\Controllers;

use App\Mail\BecomeRevisor;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

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

    public function becomeRevisor()
    {
        Mail::to('admin@presto.it')->send(new BecomeRevisor(Auth::user()));
        return redirect()->route('home')->with('success', 'Complimenti, hai richiesto di diventare revisore! Ti contatteremo al più presto!');
    }

    public function makeRevisor(User $user)
    {
        Artisan::call('app:make-user-revisor', ['email' => $user->email]);
        return redirect()->back();
    }
}