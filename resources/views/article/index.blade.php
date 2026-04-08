<x-layout>
    <section class="container my-5">

        <div class="text-center mb-5">
            <div class="home-hero-badge mb-3">
                <span class="home-hero-badge-dot"></span>
                {{ __('index.catalog') }}
            </div>

            <h1 class="home-hero-title">
                {{ __('index.title') }}
            </h1>
        </div>

        <div class="row g-4">
            @forelse ($articles as $article)
                <div class="col-12 col-md-6 col-lg-4">
                    <x-card :article="$article" />
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">

                        <div class="home-hero-badge mb-3">
                            <span class="home-hero-badge-dot"></span>
                            {{ __('index.noArticles') }}
                        </div>

                        <h2 class="mb-3">
                            {{ __('index.noArticles') }}
                        </h2>

                        <a href="{{ route('home') }}" class="home-button home-button-primary">
                            {{ __('navbar.home') }}
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