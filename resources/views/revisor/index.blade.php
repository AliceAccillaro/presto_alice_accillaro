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
                    <span class="revisor-badge">{{ __('revisor.dashboard_badge') }}</span>
                    <h1 class="revisor-title">{{ __('revisor.dashboard_title') }}</h1>
                    <p class="revisor-subtitle mb-0">
                        {{ __('revisor.dashboard_subtitle') }}
                    </p>
                </div>

                <form action="{{ route('revisor.undo') }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button class="revisor-undo-button" type="submit">
                        {{ __('revisor.undo') }}
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
                                    <div class="col-12">
                                        @php
                                            $labels = json_decode($image->labels ?? '[]', true);
                                        @endphp

                                        <div class="card shadow-sm border-0">
                                            <div class="card-body p-3">
                                                <div class="row align-items-center g-3">
                                                    <div class="col-md-4">
                                                        <div class="revisor-image-wrapper">
                                                            <img
                                                                src="{{ $image->getUrl(300, 300) }}"
                                                                class="revisor-article-image"
                                                                alt="immagine {{ $key + 1 }} dell'articolo {{ $article_to_check->title }}"
                                                            >
                                                        </div>
                                                    </div>

                                                    <div class="col-md-5">
                                                        <div class="card shadow-sm border-0 h-100">
                                                            <div class="card-body">
                                                                <h5 class="mb-3">{{ __('revisor.labels') }}</h5>

                                                                @forelse ($labels as $label)
                                                                    <p class="mb-2">{{ $label }}</p>
                                                                @empty
                                                                    <p class="text-muted mb-0">{{ __('revisor.no_labels') }}</p>
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="card shadow-sm border-0 h-100">
                                                            <div class="card-body py-3 px-4">
                                                                <div class="row g-2">
                                                                    <div class="col-12 d-flex justify-content-between align-items-center">
                                                                        <div class="text-center mx-auto">
                                                                            <i class="{{ $image->adult ?? 'text-secondary bi bi-circle-fill' }}"></i>
                                                                        </div>
                                                                        <div class="col-10">{{ __('revisor.adult') }}</div>
                                                                    </div>
                                                                    <div class="col-12 d-flex justify-content-between align-items-center">
                                                                        <div class="text-center mx-auto">
                                                                            <i class="{{ $image->violence ?? 'text-secondary bi bi-circle-fill' }}"></i>
                                                                        </div>
                                                                        <div class="col-10">{{ __('revisor.violence') }}</div>
                                                                    </div>
                                                                    <div class="col-12 d-flex justify-content-between align-items-center">
                                                                        <div class="text-center mx-auto">
                                                                            <i class="{{ $image->spoof ?? 'text-secondary bi bi-circle-fill' }}"></i>
                                                                        </div>
                                                                        <div class="col-10">{{ __('revisor.spoof') }}</div>
                                                                    </div>
                                                                    <div class="col-12 d-flex justify-content-between align-items-center">
                                                                        <div class="text-center mx-auto">
                                                                            <i class="{{ $image->racy ?? 'text-secondary bi bi-circle-fill' }}"></i>
                                                                        </div>
                                                                        <div class="col-10">{{ __('revisor.racy') }}</div>
                                                                    </div>
                                                                    <div class="col-12 d-flex justify-content-between align-items-center">
                                                                        <div class="text-center mx-auto">
                                                                            <i class="{{ $image->medical ?? 'text-secondary bi bi-circle-fill' }}"></i>
                                                                        </div>
                                                                        <div class="col-10">{{ __('revisor.medical') }}</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <div class="revisor-empty-images">
                                            {{ __('revisor.no_images') }}
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
                                    {{ __('revisor.to_review') }}
                                </span>
                            </div>

                            <h2 class="revisor-article-title">
                                {{ $article_to_check->title }}
                            </h2>

                            <p class="revisor-article-author">
                                {{ __('revisor.published_by') }} <strong>{{ $article_to_check->user->name }}</strong>
                            </p>

                            <div class="revisor-price">
                                {{ $article_to_check->price }} euro
                            </div>

                            <div class="revisor-description-box">
                                <h3 class="revisor-section-title">{{ __('revisor.description') }}</h3>
                                <p class="revisor-description-text mb-0">
                                    {{ $article_to_check->description }}
                                </p>
                            </div>

                            <div class="revisor-actions">
                                <form action="{{ route('reject', $article_to_check) }}" method="POST" class="w-100">
                                    @csrf
                                    @method('PATCH')
                                    <button class="revisor-action-button revisor-action-reject w-100" type="submit">
                                        {{ __('revisor.reject') }}
                                    </button>
                                </form>

                                <form action="{{ route('accept', $article_to_check) }}" method="POST" class="w-100">
                                    @csrf
                                    @method('PATCH')
                                    <button class="revisor-action-button revisor-action-accept w-100" type="submit">
                                        {{ __('revisor.accept') }}
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
                    <span class="revisor-badge">{{ __('revisor.all_updated') }}</span>
                    <h2 class="revisor-empty-title">{{ __('revisor.no_articles') }}</h2>
                    <p class="revisor-empty-text">
                        {{ __('revisor.no_articles_text') }}
                    </p>
                    <a href="{{ route('home') }}" class="home-button home-button-primary">
                        {{ __('revisor.back_home') }}
                    </a>
                </div>
            </div>
        @endif

    </div>
</x-layout>
