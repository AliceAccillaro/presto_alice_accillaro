<x-layout>
    <section class="container my-5">

        <div class="text-center mb-5">
            <div class="home-hero-badge mb-3">
                <span class="home-hero-badge-dot"></span>
                {{ __('show.detailTitle') }}
            </div>

            <h1 class="home-hero-title">
                {{ $article->title }}
            </h1>
        </div>

        <div class="row g-5 align-items-center">

            <div class="col-12 col-lg-6">

                @if($article->images->isNotEmpty())
                    <div id="CarouselExample" class="carousel slide">

                        <div class="carousel-inner">
                            @foreach ($article->images as $key => $image)
                                <div class="carousel-item @if ($loop->first) active @endif">
                                    <img
                                        src="{{ $image->getUrl(600, 400) }}"
                                        class="d-block w-100 rounded shadow"
                                        alt="immagine {{ $key + 1 }} dell'articolo {{ $article->title }}"
                                    >
                                </div>
                            @endforeach
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#CarouselExample" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#CarouselExample" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>

                    </div>
                @else
                    <div class="text-center py-5 border rounded">
                        <p class="text-muted mb-0">
                            {{ __('show.noImages') }}
                        </p>
                    </div>
                @endif

            </div>

            <div class="col-12 col-lg-6">

                <div class="auth-card h-100 d-flex flex-column justify-content-center">

                    <h2 class="auth-title mb-4">
                        {{ __('show.title') }}: {{ $article->title }}
                    </h2>

                    <p class="mb-3 fw-bold">
                        {{ __('show.price') }}: {{ $article->price }} euro
                    </p>

                    <div class="mb-4">
                        <h5 class="fw-bold mb-2">
                            {{ __('show.description') }}
                        </h5>

                        <p class="text-muted">
                            {{ $article->description }}
                        </p>
                    </div>

                    <a href="{{ route('home') }}" class="home-button home-button-secondary">
                        Torna alla home
                    </a>

                </div>

            </div>

        </div>

    </section>
</x-layout>
