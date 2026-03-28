<x-layout>
    <section class="auth-section">
        <div class="container">
            <div class="row justify-content-center align-items-center auth-row">
                <div class="col-12 col-md-6 col-lg-5">
                    <div class="auth-card">

                        <div class="auth-header">
                            <h1 class="auth-title">Accedi</h1>
                            <p class="auth-subtitle">
                                Inserisci le tue credenziali per accedere alla piattaforma.
                            </p>
                        </div>

                        <form method="POST" action="{{ route('login') }}" class="auth-form">
                            @csrf

                            <div class="mb-3">
                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="Email"
                                    value="{{ old('email') }}"
                                    required
                                >
                            </div>

                            <div class="mb-3">
                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="Password"
                                    required
                                >
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    {{ $errors->first() }}
                                </div>
                            @endif

                            <button type="submit" class="home-button home-button-primary w-100">
                                Accedi
                            </button>
                        </form>

                        <div class="auth-footer">
                            <p>
                                Non hai un account?
                                <a href="{{ route('register') }}">Registrati</a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>