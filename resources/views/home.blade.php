<x-layout>
    <section class="home-hero-section">
        <div class="home-hero">
            <div class="container">
                <div class="row align-items-center home-hero-row">

                    <div class="col-12 col-lg-6 order-1">
                        <div class="home-hero-content">
                            <div class="home-hero-badge">
                                <span class="home-hero-badge-dot"></span>
                                Disponibile ora
                            </div>

                            <h1 class="home-hero-title">
                                Piattaforma di vendita
                                <span class="home-hero-title-strong">che fa la differenza.</span>
                            </h1>

                            <p class="home-hero-description">
                                Una piattaforma semplice e moderna per inserire e vendere prodotti in modo veloce e intuitivo, disponibile in tutto il mondo.
                            </p>

                            <div class="home-hero-actions">
                                @auth
                                    <a href="{{ route('create.article') }}" class="home-button home-button-primary">
                                        Pubblica un articolo
                                    </a>
                                @else
                                    <a href="{{ route('register') }}" class="home-button home-button-primary">
                                        Inizia ora
                                    </a>

                                    <a href="{{ route('login') }}" class="home-button home-button-secondary">
                                        Accedi
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 order-2">
                        <div class="home-hero-visual">
                            <div class="home-hero-card home-hero-card-back"></div>
                            <div class="home-hero-card home-hero-card-middle"></div>

                            <div class="home-hero-card home-hero-card-front">
                                <div class="home-hero-card-top">
                                    <span class="home-hero-card-label">PRESTO!</span>
                                </div>

                                <div class="home-hero-card-body">
                                    <h3 class="home-hero-card-title">Inserisci e vendi prodotti in modo veloce</h3>
                                    <p class="home-hero-card-text">
                                        Metti in vendita i tuoi prodotti in pochi clic e raggiungi più clienti con la nostra piattaforma intuitiva.
                                    </p>
                                </div>

                                <div class="home-hero-card-footer">
                                    <div class="home-hero-card-box"></div>
                                    <div class="home-hero-card-box"></div>
                                    <div class="home-hero-card-box"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Ultimi articoli</h2>

                @if(request('q'))
                    <p class="text-muted mb-0">
                        Risultati per: <strong>{{ request('q') }}</strong>
                    </p>
                @endif
            </div>
        </div>

        <div class="row g-4">
            @forelse($articles as $article)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        <img
                            src="https://picsum.photos/600/400?random={{ $article->id }}"
                            class="card-img-top"
                            alt="immagine articolo {{ $article->title }}"
                        >

                        <div class="card-body d-flex flex-column">
                            <span class="badge_custom  mb-2 align-self-start">
                                {{ $article->category->name ?? 'Senza categoria' }}
                            </span>

                            <h5 class="card-title">{{ $article->title }}</h5>

                            <p class="card-text text-muted flex-grow-1">
                                {{ Str::limit($article->description, 100) }}
                            </p>

                            <p class="fw-bold mb-3">{{ $article->price }} €</p>

                            <a href="{{ route('article.show', $article) }}" class="home-button home-button-primary">
                                Dettaglio
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-light border text-center">
                        Nessun articolo trovato.
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $articles->links() }}
        </div>
    </section>
</x-layout>