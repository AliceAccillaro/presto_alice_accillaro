<x-layout>
    <div class="container py-5 revisor-page">

        @if (session()->has('message'))
            <div class="row justify-content-center mb-4">
                <div class="col-lg-6">
                    <div class="alert alert-success text-center shadow-sm rounded-pill mb-0">
                        {{ session('message') }}
                    </div>
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="row justify-content-center mb-4">
                <div class="col-lg-6">
                    <div class="alert alert-danger text-center shadow-sm rounded-pill mb-0">
                        {{ session('error') }}
                    </div>
                </div>
            </div>
        @endif

        @if (session()->has('errorMessage'))
            <div class="row justify-content-center mb-4">
                <div class="col-lg-6">
                    <div class="alert alert-danger text-center shadow-sm rounded-pill mb-0">
                        {{ session('errorMessage') }}
                    </div>
                </div>
            </div>
        @endif

        <div class="revisor-header mb-5">
            <div class="revisor-header-card">
                <div>
                    <span class="revisor-badge">Moderazione</span>
                    <h1 class="revisor-title">Revisor dashboard</h1>
                    <p class="revisor-subtitle mb-0">
                        Gestisci gli articoli in attesa di approvazione in modo semplice e veloce.
                    </p>
                </div>

                <form action="{{ route('revisor.undo') }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button class="revisor-undo-button" type="submit">
                        Annulla ultima azione
                    </button>
                </form>
            </div>
        </div>

        @if ($article_to_check)
            <div class="revisor-article-card">
                <div class="row g-4 align-items-start">

                    <div class="col-lg-7">
                        <div class="revisor-gallery-card">
                            <div class="row g-3">
                                @forelse ($article_to_check->images as $key => $image)
                                    <div class="col-12 col-sm-6">
                                        <div class="revisor-image-wrapper">
                                            <img
                                                src="{{ $image->getUrl(600, 400) }}"
                                                class="revisor-article-image"
                                                alt="immagine {{ $key + 1 }} dell'articolo {{ $article_to_check->title }}"
                                            >
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <div class="revisor-empty-images">
                                            Nessuna immagine caricata
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="revisor-info-card">
                            <div class="revisor-meta-top">
                                <span class="revisor-category-badge">
                                    {{ $article_to_check->category->name }}
                                </span>
                                <span class="revisor-status-badge">
                                    Da revisionare
                                </span>
                            </div>

                            <h2 class="revisor-article-title">
                                {{ $article_to_check->title }}
                            </h2>

                            <p class="revisor-article-author">
                                Pubblicato da <strong>{{ $article_to_check->user->name }}</strong>
                            </p>

                            <div class="revisor-price">
                                {{ $article_to_check->price }} euro
                            </div>

                            <div class="revisor-description-box">
                                <h3 class="revisor-section-title">Descrizione</h3>
                                <p class="revisor-description-text mb-0">
                                    {{ $article_to_check->description }}
                                </p>
                            </div>

                            <div class="revisor-actions">
                                <form action="{{ route('reject', $article_to_check) }}" method="POST" class="w-100">
                                    @csrf
                                    @method('PATCH')
                                    <button class="revisor-action-button revisor-action-reject w-100" type="submit">
                                        Rifiuta
                                    </button>
                                </form>

                                <form action="{{ route('accept', $article_to_check) }}" method="POST" class="w-100">
                                    @csrf
                                    @method('PATCH')
                                    <button class="revisor-action-button revisor-action-accept w-100" type="submit">
                                        Accetta
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @else
            <div class="revisor-empty-state">
                <div class="revisor-empty-card">
                    <span class="revisor-badge">Tutto aggiornato</span>
                    <h2 class="revisor-empty-title">Nessun articolo da revisionare</h2>
                    <p class="revisor-empty-text">
                        Al momento non ci sono articoli in attesa. Torna piu tardi oppure rientra in homepage.
                    </p>
                    <a href="{{ route('home') }}" class="home-button home-button-primary">
                        Torna all'homepage
                    </a>
                </div>
            </div>
        @endif

    </div>
</x-layout>
