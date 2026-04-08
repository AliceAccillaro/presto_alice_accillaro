<x-layout>
    <section class="auth-section">
        <div class="container">
            <div class="row justify-content-center align-items-center auth-row">
                <div class="col-12 col-md-8 col-lg-6">

                    <div class="auth-card">

                        <div class="auth-header text-center">
                            <div class="home-hero-badge mb-4">
                                <span class="home-hero-badge-dot"></span>
                                Collabora con Presto
                            </div>

                            <h1 class="auth-title">Lavora con noi</h1>

                            <p class="auth-subtitle">
                                Vuoi collaborare con il team Presto come revisore? Inviaci la tua richiesta.
                            </p>
                        </div>

                        @if (session('message'))
                            <div class="alert alert-success text-center">
                                {{ session('message') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger text-center">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (Auth::user()->is_revisor)
                            <div class="text-center py-3">
                                <h4 class="mb-3 text-success">Sei già un revisore ✔</h4>
                                <p class="text-muted mb-4">
                                    Puoi accedere direttamente alla dashboard revisori.
                                </p>

                                <a href="{{ route('revisor.index') }}" class="home-button home-button-primary">
                                    Vai alla dashboard
                                </a>
                            </div>
                        @else
                            <form action="{{ route('send.revisor.request') }}" method="POST" class="auth-form">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Nome utente</label>
                                    <input type="text" value="{{ Auth::user()->name }}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Email</label>
                                    <input type="email" value="{{ Auth::user()->email }}" disabled>
                                </div>

                                <div class="mb-4">
                                    <label for="message" class="form-label fw-semibold">
                                        Perché vuoi diventare revisore?
                                    </label>

                                    <textarea
                                        name="message"
                                        id="message"
                                        rows="5"
                                        class="form-control @error('message') is-invalid @enderror"
                                        placeholder="Scrivi qui la tua motivazione..."
                                    >{{ old('message') }}</textarea>

                                    @error('message')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="home-button home-button-primary border-0">
                                        Invia richiesta
                                    </button>
                                </div>
                            </form>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </section>
</x-layout>