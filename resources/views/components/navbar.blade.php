<nav class="site-navbar-wrapper">
    <div class="container">
        <nav class="site-navbar navbar navbar-expand-lg">

            <!-- LOGO -->
            <a class="site-navbar-brand" href="{{ route('home') }}">
                <span class="site-navbar-brand-icon">
                    <img src="{{ asset('images/presto-logo.png') }}" alt="Presto Logo" class="site-navbar-brand-logo">
                </span>
                <span class="site-navbar-brand-text">Presto</span>
            </a>

            <!-- TOGGLER -->
            <button
                class="navbar-toggler site-navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#siteNavbarContent"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- CONTENUTO -->
            <div class="collapse navbar-collapse" id="siteNavbarContent">

                <!-- LINK CENTRALI -->
                <ul class="navbar-nav mx-auto site-navbar-links">

                    <!-- HOME -->
                    <li class="nav-item">
                        <a class="nav-link site-navbar-link" href="{{ route('home') }}">
                            Home
                        </a>
                    </li>

                    <!-- CATEGORIE -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle site-navbar-link" href="#" role="button" data-bs-toggle="dropdown">
                            Categorie
                        </a>

                        <ul class="dropdown-menu">

                            @forelse ($categories as $category)
                                <li>
                                    <a class="dropdown-item" href="{{ route('byCategory', $category) }}">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @empty
                                <li>
                                    <span class="dropdown-item text-muted">
                                        Nessuna categoria
                                    </span>
                                </li>
                            @endforelse

                        </ul>
                    </li>

                    <!-- CREA ARTICOLO -->
                    @auth
                    <li class="nav-item">
                        <a class="nav-link site-navbar-link" href="{{ route('create.article') }}">
                            Crea Articolo
                        </a>
                    </li>
                    @endauth

                </ul>

                <!-- DESTRA -->
                <div class="site-navbar-actions">

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

                                <li><hr class="dropdown-divider"></li>

                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="px-3">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <div class="site-navbar-buttons">
                            <a class="site-navbar-button-login" href="{{ route('login') }}">
                                Accedi
                            </a>
                            <a class="site-navbar-button-register" href="{{ route('register') }}">
                                Registrati
                            </a>
                        </div>
                    @endauth

                </div>

            </div>
        </nav>
    </div>
</nav>