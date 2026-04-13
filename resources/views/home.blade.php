<x-layout>
    <section class="home-hero-section">
        <div class="home-hero">
            <div class="container">
                <div class="row align-items-center home-hero-row">

                    <div class="col-12 col-lg-6 order-1">
                        <div class="home-hero-content">
                            <div class="home-hero-badge">
                                <span class="home-hero-badge-dot"></span>
                                {{ __('home.availableNow') }}
                            </div>

                            <h1 class="home-hero-title">
                                {{ __('home.platformTitle') }}
                                <span class="home-hero-title-strong">
                                    {{ __('home.platformStrong') }}
                                </span>
                            </h1>

                            <p class="home-hero-description">
                                {{ __('home.description') }}
                            </p>

                            <div class="home-hero-actions">
                                @auth
                                    <a href="{{ route('create.article') }}" class="home-button home-button-primary">
                                        {{ __('home.publishArticle') }}
                                    </a>
                                @else
                                    <a href="{{ route('register') }}" class="home-button home-button-primary">
                                        {{ __('home.startNow') }}
                                    </a>

                                    <a href="{{ route('login') }}" class="home-button home-button-secondary">
                                        {{ __('home.login') }}
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
                                    <h3 class="home-hero-card-title">
                                        {{ __('home.cardTitle') }}
                                    </h3>
                                    <p class="home-hero-card-text">
                                        {{ __('home.cardText') }}
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
                <h2 class="mb-1">{{ __('home.latestArticles') }}</h2>

                @if (request('q'))
                    <p class="text-muted mb-0">
                        {{ __('home.resultsFor') }} <strong>{{ request('q') }}</strong>
                    </p>
                @endif
            </div>
        </div>

        <div class="row g-4">
            @forelse($articles as $article)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ $article->images->isNotEmpty() ? $article->images->first()->getUrl(600, 400) : 'https://picsum.photos/200' }}"
                            class="card-img-top product-thumb" alt="{{ __('home.image_alt', ['title' => $article->title]) }}">

                        <div class="card-body d-flex flex-column">
                            <span class="badge_custom mb-2 align-self-start">
                                {{ $article->category->translated_name ?? __('home.noCategory') }}
                            </span>

                            <h5 class="card-title">{{ $article->title }}</h5>

                            <p class="card-text text-muted flex-grow-1">
                                {{ Str::limit($article->description, 100) }}
                            </p>

                            <p class="fw-bold mb-3">{{ $article->price }} {{ __('home.currency') }}</p>

                            <a href="{{ route('article.show', $article) }}" class="home-button home-button-primary">
                                {{ __('home.detail') }}
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-light border text-center">
                        {{ __('home.noArticles') }}
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $articles->links() }}
        </div>
    </section>
</x-layout>
