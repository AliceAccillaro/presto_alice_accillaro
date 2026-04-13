<div class="article-card h-100 d-flex flex-column">
    <img
        src="{{ $article->images->isNotEmpty() ? $article->images->first()->getUrl(600, 400) : 'https://picsum.photos/600/400' }}"
        class="article-card-image"
        alt="immagine dell'articolo {{ $article->title }}"
    >

    <div class="article-card-body d-flex flex-column">
        <a href="{{ route('byCategory', ['category' => $article->category]) }}"
           class="badge_custom mb-2 align-self-start text-decoration-none">
            {{ $article->category->translated_name ?? __('card.noCategory') }}
        </a>

        <h4 class="article-card-title">
            {{ $article->title }}
        </h4>

        <p class="article-card-description flex-grow-1">
            {{ \Illuminate\Support\Str::limit($article->description, 100) }}
        </p>

        <p class="article-card-price mb-3">
            {{ $article->price }} euro
        </p>

        <div class="mt-auto">
            <a href="{{ route('article.show', ['article' => $article]) }}"
               class="home-button home-button-primary w-100">
                {{ __('card.detail') }}
            </a>
        </div>
    </div>
</div>
