<nav class="site-navbar-wrapper">
    <div class="container">
        <nav class="site-navbar navbar navbar-expand-lg">

            <a class="site-navbar-brand" href="{{ route('home') }}">
                <span class="site-navbar-brand-icon">
                    <img src="{{ asset('images/presto-logo.png') }}" alt="Presto Logo" class="site-navbar-brand-logo">
                </span>
                <span class="nav-text-presto">PRESTO!</span>
            </a>

            <button class="navbar-toggler site-navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#siteNavbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="siteNavbarContent">

                <ul class="navbar-nav mx-auto site-navbar-links">

                    <li class="nav-item">
                        <a class="nav-link site-navbar-link" href="{{ route('home') }}">
                            {{ __('navbar.home') }}
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle site-navbar-link" href="#" role="button"
                            data-bs-toggle="dropdown">
                            {{ __('navbar.categories') }}
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('home') }}">
                                    {{ __('navbar.allCategories') }}
                                </a>
                            </li>

                            @forelse ($categories as $category)
                                <li>
                                    <a class="dropdown-item" href="{{ route('byCategory', $category) }}">
                                        {{ $category->name }}
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
                            <a class="nav-link site-navbar-link" href="{{ route('create.article') }}">
                                {{ __('navbar.createArticle') }}
                            </a>
                        </li>
                    @endauth

                </ul>

                @php
                    $currentCategory = request()->route('category');
                @endphp

                <form action="{{ $currentCategory ? route('byCategory', $currentCategory) : route('home') }}"
                    method="GET" class="d-flex align-items-center me-3">
                    <input type="text" name="q" class="form-control me-2 search-bord"
                        placeholder="{{ __('navbar.searchPlaceholder') }}" value="{{ request('q') }}">
                    <button type="submit" class="site-navbar-button-register ">
                        {{ __('navbar.search') }}
                    </button>
                </form>

                <div class="site-navbar-actions d-flex align-items-center gap-3">

                    <a href="{{ route('setLocale', 'it') }}">
                        <x-flag-language-it class="locale-flag" />
                    </a>

                    <a href="{{ route('setLocale', 'en') }}">
                        <x-flag-language-en class="locale-flag" />
                    </a>

                    <a href="{{ route('setLocale', 'es') }}">
                        <x-flag-language-es class="locale-flag" />
                    </a>

                    @auth
                        <div class="dropdown">
                            <a class="site-navbar-user dropdown-toggle" href="#" data-bs-toggle="dropdown">
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
                            <a class="home-button home-button-secondary" href="{{ route('login') }}">
                                {{ __('navbar.login') }}
                            </a>
                            <a class="home-button home-button-primary" href="{{ route('register') }}">
                                {{ __('navbar.register') }}
                            </a>
                        </div>
                    @endauth

                </div>

            </div>
        </nav>
    </div>
</nav>
