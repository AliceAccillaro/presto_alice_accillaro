<nav class="site-navbar-wrapper">
    @php
        $categories = $categories ?? collect();
    @endphp

    <div class="site-navbar-container container-fluid">
        <nav class="site-navbar navbar navbar-expand-xl">

            <a class="site-navbar-brand flex-shrink-0" href="{{ route('home') }}">
                <span class="site-navbar-brand-icon">
                    <img src="{{ asset('images/presto-logo.png') }}" alt="Presto Logo" class="site-navbar-brand-logo">
                </span>
                <span class="nav-text-presto">PRESTO!</span>
            </a>

            <button
                class="navbar-toggler site-navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#siteNavbarContent"
                aria-controls="siteNavbarContent"
                aria-expanded="false"
                aria-label="{{ __('navbar.toggle_navigation') }}"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse mt-3 mt-xl-0" id="siteNavbarContent">

                <ul class="navbar-nav align-items-xl-center gap-xl-2 mx-xl-4 mb-3 mb-xl-0">

                    <li class="nav-item">
                        <a class="nav-link site-navbar-link text-nowrap" href="{{ route('home') }}">
                            {{ __('navbar.home') }}
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle site-navbar-link text-nowrap" href="#" role="button" data-bs-toggle="dropdown">
                            {{ __('navbar.categories') }}
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('article.index') }}">
                                    {{ __('navbar.allCategories') }}
                                </a>
                            </li>

                            @forelse ($categories as $category)
                                <li>
                                    <a class="dropdown-item" href="{{ route('byCategory', $category) }}">
                                        {{ $category->translated_name }}
                                    </a>
                                </li>
                            @empty
                                <li>
                                    <span class="dropdown-item text-muted">
                                        {{ __('navbar.noCategories') }}
                                    </span>
                                </li>
                            @endforelse
                        </ul>
                    </li>

                    @auth
                        <li class="nav-item">
                            <a class="nav-link site-navbar-link text-nowrap" href="{{ route('create.article') }}">
                                {{ __('navbar.createArticle') }}
                            </a>
                        </li>
                    @endauth

                    <li class="nav-item">
                        @auth
                            <a class="nav-link site-navbar-link text-nowrap" href="{{ route('work.with.us') }}">
                                {{ __('navbar.workWithUs') }}
                            </a>
                        @else
                            <a class="nav-link site-navbar-link text-nowrap" href="{{ route('login') }}">
                                {{ __('navbar.workWithUs') }}
                            </a>
                        @endauth
                    </li>

                </ul>

                @php
                    $currentCategory = request()->route('category');
                @endphp

                <div class="d-xl-flex align-items-xl-center ms-xl-auto gap-3 w-100 justify-content-xl-end">

                    <form
                        action="{{ $currentCategory ? route('byCategory', $currentCategory) : route('home') }}"
                        method="GET"
                        class="site-navbar-search-form d-flex align-items-center flex-grow-1 flex-xl-grow-0 mb-3 mb-xl-0"
                    >
                        <input
                            type="text"
                            name="q"
                            class="form-control me-2 search-bord site-navbar-search-input"
                            placeholder="{{ __('navbar.searchPlaceholder') }}"
                            value="{{ request('q') }}"
                        >
                        <button type="submit" class="site-navbar-button-register flex-shrink-0">
                            {{ __('navbar.search') }}
                        </button>
                    </form>

                    <div class="d-flex align-items-center gap-3 mb-3 mb-xl-0">
                        <a href="{{ route('setLocale', 'it') }}" class="text-decoration-none">
                            <x-flag-language-it class="locale-flag" />
                        </a>

                        <a href="{{ route('setLocale', 'en') }}" class="text-decoration-none">
                            <x-flag-language-en class="locale-flag" />
                        </a>

                        <a href="{{ route('setLocale', 'es') }}" class="text-decoration-none">
                            <x-flag-language-es class="locale-flag" />
                        </a>
                    </div>

                    @auth
                        <div class="dropdown">
                            <a class="site-navbar-user dropdown-toggle text-nowrap" href="#" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i>
                                {{ Auth::user()->name }}
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <span class="dropdown-item-text">
                                        {{ Auth::user()->email }}
                                    </span>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                @if (Auth::user()->is_revisor)
                                    <li>
                                        <a class="dropdown-item" href="{{ route('revisor.index') }}">
                                            {{ __('navbar.revisorZone') }}
                                            <span class="badge rounded-pill bg-danger">
                                                {{ \App\Models\Article::toBeRevisionedCount() }}
                                            </span>
                                        </a>
                                    </li>

                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                @endif

                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="px-3">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            {{ __('navbar.logout') }}
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <div class="site-navbar-buttons">
                            <a class="home-button home-button-secondary text-nowrap" href="{{ route('login') }}">
                                {{ __('navbar.login') }}
                            </a>

                            <a class="home-button home-button-primary text-nowrap" href="{{ route('register') }}">
                                {{ __('navbar.register') }}
                            </a>
                        </div>
                    @endauth

                </div>

            </div>
        </nav>
    </div>
</nav>
