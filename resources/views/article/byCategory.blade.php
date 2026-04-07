<x-layout>
    <section class="container my-5">
        <div class="mb-4">
            <h1 class="mb-2">Categoria: {{ $category->name }}</h1>

            @if (request('q'))
                <p class="text-muted mb-0">
                    Risultati per: <strong>{{ request('q') }}</strong>
                </p>
            @endif
        </div>

        <div class="row g-4">
            @forelse($articles as $article)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ $article->images->isNotEmpty() ? $article->images->first()->getUrl(600, 400) : 'https://picsum.photos/200' }}"
                            class="card-img-top" alt="immagine dell'articolo {{ $article->title }}">

                        <div class="card-body d-flex flex-column">
                            <span class="badge bg-secondary mb-2 align-self-start">
                                {{ $article->category->name ?? 'Senza categoria' }}
                            </span>

                            <h5 class="card-title">{{ $article->title }}</h5>

                            <p class="card-text text-muted flex-grow-1">
                                {{ Str::limit($article->description, 100) }}
                            </p>

                            <p class="fw-bold mb-3">{{ $article->price }} €</p>

                            <a href="{{ route('article.show', $article) }}" class="btn btn-dark">
                                Dettaglio
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-light border text-center">
                        Nessun articolo trovato in questa categoria.
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $articles->links() }}
        </div>
    </section>
</x-layout>
