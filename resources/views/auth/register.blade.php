<x-layout>
    <section class="auth-section">
        <div class="container">
            <div class="row justify-content-center align-items-center auth-row">

                <div class="col-12 col-md-6 col-lg-5">
                    <div class="auth-card">

                        <div class="auth-header">
                            <h1 class="auth-title">Crea un account</h1>
                            <p class="auth-subtitle">
                                Inizia subito a vendere i tuoi prodotti in modo semplice e veloce.
                            </p>
                        </div>

                        <form method="POST" action="{{ route('register') }}" class="auth-form">
                            @csrf

                            <div class="mb-3">
                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    placeholder="Nome"
                                    value="{{ old('name') }}"
                                    required
                                >
                            </div>

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

                            <div class="mb-3">
                                <input
                                    type="password"
                                    name="password_confirmation"
                                    class="form-control"
                                    placeholder="Conferma password"
                                    required
                                >
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <button type="submit" class="home-button home-button-primary w-100">
                                Registrati
                            </button>
                        </form>

                        <div class="auth-footer">
                            <p>
                                Hai già un account?
                                <a href="{{ route('login') }}">Accedi</a>
                            </p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
</x-layout>