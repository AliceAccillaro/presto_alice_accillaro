<div>
    @if (session()->has('message'))
        <div class="alert alert-success text-center rounded-pill shadow-sm mb-4">
            {{ session('message') }}
        </div>
    @endif

    <section class="create-article-section">
        <form class="create-article-card" wire:submit.prevent="save">

            <div class="create-article-header text-center">
                <div class="home-hero-badge mb-4">
                    <span class="home-hero-badge-dot"></span>
                    {{ __('createArticle.badge') }}
                </div>

                <h1 class="create-article-title">{{ __('createArticle.title') }}</h1>

                <p class="create-article-subtitle">
                    {{ __('createArticle.subtitle') }}
                </p>
            </div>

            <div class="mb-3">
                <label class="create-article-label">{{ __('createArticle.formTitle') }}</label>
                <input type="text" class="create-article-input" wire:model="title">

                @error('title')
                    <p class="fst-italic text-danger mt-2 mb-0">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="create-article-label">{{ __('createArticle.formDescription') }}</label>
                <textarea class="create-article-textarea" rows="5" wire:model="description"></textarea>

                @error('description')
                    <p class="fst-italic text-danger mt-2 mb-0">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="create-article-label">{{ __('createArticle.formPrice') }}</label>
                <input type="text" class="create-article-input" wire:model="price">

                @error('price')
                    <p class="fst-italic text-danger mt-2 mb-0">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="create-article-label">{{ __('createArticle.formCategory') }}</label>
                <select class="create-article-select" wire:model="category">
                    <option value="" disabled selected>{{ __('createArticle.selectCategory') }}</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->translated_name }}</option>
                    @endforeach
                </select>

                @error('category')
                    <p class="fst-italic text-danger mt-2 mb-0">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="create-article-label">{{ __('createArticle.formImages') }}</label>
                <input
                    type="file"
                    wire:model="temporary_images"
                    multiple
                    class="create-article-input @error('temporary_images.*') is-invalid @enderror"
                >

                @error('temporary_images.*')
                    <p class="fst-italic text-danger mt-2 mb-0">{{ $message }}</p>
                @enderror

                <div class="create-article-upload-notice" wire:loading wire:target="temporary_images">
                    <span class="create-article-upload-spinner" aria-hidden="true"></span>
                    <span>Caricamento immagini in corso: attendi la comparsa dell'anteprima prima di creare l'articolo.</span>
                </div>
            </div>

            @if (!empty($temporary_images))
                <div class="mb-4">
                    <p class="create-article-preview-title">{{ __('createArticle.previewTitle') }}</p>

                    <div class="create-article-preview-box">
                        <div class="create-article-preview-grid">
                            @foreach ($temporary_images as $key => $image)
                                <div class="create-article-preview-item">
                                    <div
                                        class="img-preview"
                                        style="background-image: url('{{ $image->temporaryUrl() }}');">
                                    </div>

                                    <button
                                        type="button"
                                        class="home-button home-button-secondary mt-3 py-2 px-3"
                                        wire:click="removeImage({{ $key }})"
                                    >
                                        {{ __('createArticle.removeImage') }}
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <div class="d-flex justify-content-end mt-4">
                <button
                    type="submit"
                    class="home-button home-button-primary border-0"
                    wire:loading.attr="disabled"
                    wire:target="temporary_images"
                >
                    <span wire:loading.remove wire:target="temporary_images">
                        {{ __('createArticle.submit') }}
                    </span>
                    <span wire:loading wire:target="temporary_images">
                        Caricamento...
                    </span>
                </button>
            </div>

        </form>
    </section>
</div>
