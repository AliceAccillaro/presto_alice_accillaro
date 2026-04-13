<x-layout>
    <section class="container my-5">

        <div class="mb-5 text-center">
            <div class="home-hero-badge mb-3">
                <span class="home-hero-badge-dot"></span>
                {{ __('article.category') }}
            </div>

            <h1 class="home-hero-title mb-3">
                {{ $category->translated_name }}
            </h1>

            @if (request('q'))
                <p class="home-hero-description mx-auto">
                    {{ __('article.resultsFor') }}: <strong>{{ request('q') }}</strong>
                </p>
            @endif
        </div>

        <div class="row g-4">
            @forelse($articles as $article)
                <div class="col-12 col-md-6 col-lg-4">
                    <x-card :article="$article" />
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">

                        <div class="home-hero-badge mb-3">
                            <span class="home-hero-badge-dot"></span>
                            {{ __('article.noArticles') }}
                        </div>

                        <h2 class="mb-3">
                            {{ __('article.noArticles') }}
                        </h2>

                        <p class="text-muted mb-4">
                            {{ __('article.noArticlesDesc') }}
                        </p>

                        <a href="{{ route('home') }}" class="home-button home-button-primary">
                            {{ __('article.backHome') }}
                        </a>

                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-5 d-flex justify-content-center">
            {{ $articles->links() }}
        </div>

    </section>
</x-layout>
