<?php

namespace App\Http\Controllers;

use App\Mail\BecomeRevisor;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RevisorController extends Controller
{
    public function index()
    {
        $article_to_check = Article::with(['category', 'user', 'images'])
            ->whereNull('is_accepted')
            ->orderBy('created_at', 'asc')
            ->first();

        $reviewed_articles = Article::with(['category', 'user'])
            ->whereNotNull('is_accepted')
            ->orderBy('updated_at', 'desc')
            ->take(8)
            ->get();

        $categories = Category::orderBy('name')->get();

        return view('revisor.index', compact('article_to_check', 'reviewed_articles', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|min:5|max:255',
            'description' => 'required|min:10',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $article->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);

        return redirect()->back()->with('message', __('revisor.article_updated'));
    }

    public function accept(Article $article)
    {
        $article->is_accepted = true;
        $article->save();

        session()->put('last_article_id', $article->id);

        return redirect()->back()->with('message', __('revisor.article_accepted'));
    }

    public function reject(Article $article)
    {
        $article->is_accepted = false;
        $article->save();

        session()->put('last_article_id', $article->id);

        return redirect()->back()->with('message', __('revisor.article_rejected'));
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
            ->with('success', __('revisor.request_sent'));
    }

    public function undoLastAction()
    {
        $articleId = session('last_article_id');

        if (!$articleId) {
            return redirect()->back()->with('error', __('revisor.no_action_to_undo'));
        }

        $article = Article::find($articleId);

        if (!$article) {
            return redirect()->back()->with('error', __('revisor.article_not_found'));
        }

        $article->is_accepted = null;
        $article->save();

        session()->forget('last_article_id');

        return redirect()->back()->with('message', __('revisor.undo_success'));
    }
}
