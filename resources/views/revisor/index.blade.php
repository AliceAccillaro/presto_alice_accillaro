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
                                                                alt="{{ __('revisor.image_alt', ['number' => $key + 1, 'title' => $article_to_check->title]) }}"
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
                                <div class="d-flex flex-wrap gap-2">
                                    <span class="revisor-category-badge">
                                        {{ $article_to_check->category->translated_name }}
                                    </span>

                                    @if ($article_to_check->updated_at && $article_to_check->updated_at->gt($article_to_check->created_at))
                                        <span class="revisor-category-badge">
                                            {{ __('revisor.edited_by_revisor') }}
                                        </span>
                                    @endif
                                </div>

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
                                {{ $article_to_check->price }} {{ __('revisor.currency') }}
                            </div>

                            <form action="{{ route('revisor.article.update', $article_to_check) }}" method="POST" class="mb-4">
                                @csrf
                                @method('PATCH')

                                <div class="mb-3">
                                    <label class="create-article-label" for="revisor-title">
                                        {{ __('revisor.edit_title') }}
                                    </label>
                                    <input
                                        id="revisor-title"
                                        type="text"
                                        name="title"
                                        class="create-article-input"
                                        value="{{ old('title', $article_to_check->title) }}"
                                    >
                                    @error('title')
                                        <p class="fst-italic text-danger mt-2 mb-0">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="create-article-label" for="revisor-price">
                                        {{ __('revisor.edit_price') }}
                                    </label>
                                    <input
                                        id="revisor-price"
                                        type="text"
                                        name="price"
                                        class="create-article-input"
                                        value="{{ old('price', $article_to_check->price) }}"
                                    >
                                    @error('price')
                                        <p class="fst-italic text-danger mt-2 mb-0">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="create-article-label" for="revisor-category">
                                        {{ __('revisor.edit_category') }}
                                    </label>
                                    <select id="revisor-category" name="category_id" class="create-article-select">
                                        @foreach ($categories as $category)
                                            <option
                                                value="{{ $category->id }}"
                                                @selected(old('category_id', $article_to_check->category_id) == $category->id)
                                            >
                                                {{ $category->translated_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <p class="fst-italic text-danger mt-2 mb-0">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="revisor-description-box">
                                    <h3 class="revisor-section-title">{{ __('revisor.edit_description') }}</h3>
                                    <textarea
                                        name="description"
                                        class="create-article-textarea"
                                        rows="5"
                                    >{{ old('description', $article_to_check->description) }}</textarea>
                                    @error('description')
                                        <p class="fst-italic text-danger mt-2 mb-0">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button class="home-button home-button-secondary w-100 mb-4" type="submit">
                                    {{ __('revisor.save_changes') }}
                                </button>
                            </form>

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

        <div class="revisor-history-section mt-5">
            <div class="revisor-header-card">
                <div>
                    <span class="revisor-badge">{{ __('revisor.history_badge') }}</span>
                    <h2 class="revisor-section-title mt-3 mb-2">{{ __('revisor.history_title') }}</h2>
                    <p class="revisor-subtitle mb-0">
                        {{ __('revisor.history_subtitle') }}
                    </p>
                </div>
            </div>

            <div class="row g-4 mt-1">
                @forelse ($reviewed_articles as $reviewed_article)
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="revisor-info-card h-100">
                            <div class="revisor-history-badges mb-3">
                                <span class="revisor-category-badge">
                                    {{ $reviewed_article->category->translated_name }}
                                </span>

                                <span class="revisor-status-badge {{ $reviewed_article->is_accepted ? 'revisor-history-accepted' : 'revisor-history-rejected' }}">
                                    {{ $reviewed_article->is_accepted ? __('revisor.status_accepted') : __('revisor.status_rejected') }}
                                </span>
                            </div>

                            <h3 class="revisor-article-title fs-4">
                                {{ $reviewed_article->title }}
                            </h3>

                            <div class="revisor-history-meta">
                                <p class="revisor-article-author mb-2">
                                    {{ __('revisor.published_by') }} <strong>{{ $reviewed_article->user->name }}</strong>
                                </p>

                                <p class="mb-0 text-muted">
                                    {{ __('revisor.reviewed_on') }}
                                    <strong>{{ $reviewed_article->updated_at?->format('d/m/Y H:i') }}</strong>
                                </p>
                            </div>

                            <div class="revisor-price mb-3">
                                {{ $reviewed_article->price }} {{ __('revisor.currency') }}
                            </div>

                            @if ($reviewed_article->updated_at && $reviewed_article->updated_at->gt($reviewed_article->created_at))
                                <span class="revisor-category-badge revisor-history-edited mb-3">
                                    {{ __('revisor.edited_by_revisor') }}
                                </span>
                            @endif

                            <p class="revisor-history-description mb-0 text-muted">
                                {{ \Illuminate\Support\Str::limit($reviewed_article->description, 100) }}
                            </p>

                            @if ($reviewed_article->is_accepted)
                                <details class="revisor-history-edit mt-4">
                                    <summary class="revisor-history-summary">
                                        {{ __('revisor.edit_approved_article') }}
                                    </summary>

                                    <form action="{{ route('revisor.article.update', $reviewed_article) }}" method="POST" class="mt-3">
                                        @csrf
                                        @method('PATCH')

                                        <div class="mb-3">
                                            <label class="create-article-label" for="history-title-{{ $reviewed_article->id }}">
                                                {{ __('revisor.edit_title') }}
                                            </label>
                                            <input
                                                id="history-title-{{ $reviewed_article->id }}"
                                                type="text"
                                                name="title"
                                                class="create-article-input"
                                                value="{{ $reviewed_article->title }}"
                                            >
                                        </div>

                                        <div class="mb-3">
                                            <label class="create-article-label" for="history-price-{{ $reviewed_article->id }}">
                                                {{ __('revisor.edit_price') }}
                                            </label>
                                            <input
                                                id="history-price-{{ $reviewed_article->id }}"
                                                type="text"
                                                name="price"
                                                class="create-article-input"
                                                value="{{ $reviewed_article->price }}"
                                            >
                                        </div>

                                        <div class="mb-3">
                                            <label class="create-article-label" for="history-category-{{ $reviewed_article->id }}">
                                                {{ __('revisor.edit_category') }}
                                            </label>
                                            <select
                                                id="history-category-{{ $reviewed_article->id }}"
                                                name="category_id"
                                                class="create-article-select"
                                            >
                                                @foreach ($categories as $category)
                                                    <option
                                                        value="{{ $category->id }}"
                                                        @selected($reviewed_article->category_id == $category->id)
                                                    >
                                                        {{ $category->translated_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="create-article-label" for="history-description-{{ $reviewed_article->id }}">
                                                {{ __('revisor.edit_description') }}
                                            </label>
                                            <textarea
                                                id="history-description-{{ $reviewed_article->id }}"
                                                name="description"
                                                class="create-article-textarea"
                                                rows="4"
                                            >{{ $reviewed_article->description }}</textarea>
                                        </div>

                                        <button class="home-button home-button-secondary w-100" type="submit">
                                            {{ __('revisor.save_changes') }}
                                        </button>
                                    </form>
                                </details>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="revisor-empty-images">
                            {{ __('revisor.history_empty') }}
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</x-layout>
