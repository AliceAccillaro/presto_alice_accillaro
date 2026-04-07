<div class="card mx-auto card-w shadow text-center mb-3">
    @if ($article->images->count())
        <img src="{{ asset('storage/' . $article->images->first()->path) }}"
             class="card-img-top"
             alt="immagine dell'articolo {{ $article->title }}">
    @else
        <img src="https://picsum.photos/200"
             class="card-img-top"
             alt="immagine placeholder dell'articolo {{ $article->title }}">
    @endif

    <div class="card-body">
        <h4 class="card-title">{{ $article->title }}</h4>
        <h6 class="card-subtitle mb-2 text-body-secondary">{{ $article->price }} €</h6>
        <div class="d-flex justify-content-evenly align-items-center mt-5">
            <a href="{{ route('articles.show', ['article' => $article]) }}" class="btn btn-primary">Dettaglio</a>
            <a href="{{ route('byCategory', ['category' => $article->category]) }}" class="btn btn-outline-info">
                {{ $article->category->name }}
            </a>
        </div>
    </div>
</div>