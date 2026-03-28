<x-layout>
    <section class="home-hero">
        <div class="container">
            <div class="row align-items-center home-hero-row">

                <div class="col-12 col-lg-6 order-1">
                    <div class="home-hero-content">
                        <div class="home-hero-badge">
                            <span class="home-hero-badge-dot"></span>
                            Disponibile ora
                        </div>

                        <h1 class="home-hero-title">
                            Piattaforma di vendita
                            <span class="home-hero-title-strong">che fa la differenza.</span>
                        </h1>

                        <p class="home-hero-description">
                            Una piattaforma semplice e moderna per inserire e vendere prodotti in modo veloce e intuitivo, disponibile in tutto il mondo.
                        </p>

                        <div class="home-hero-actions">
                            <a href="{{ route('register') }}" class="home-button home-button-primary">
                                Inizia ora
                            </a>

                            <a href="{{ route('login') }}" class="home-button home-button-secondary">
                                Accedi
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6 order-2">
                    <div class="home-hero-visual">
                        <div class="home-hero-card home-hero-card-back"></div>
                        <div class="home-hero-card home-hero-card-middle"></div>

                        <div class="home-hero-card home-hero-card-front">
                            <div class="home-hero-card-top">
                                <span class="home-hero-card-label">PRESTO</span>
                            </div>

                            <div class="home-hero-card-body">
                                <h3 class="home-hero-card-title">Inserisci e vendi prodotti in modo veloce</h3>
                                <p class="home-hero-card-text">
                                    Metti in vendita i tuoi prodotti in pochi clic e raggiungi più clienti con la nostra piattaforma intuitiva.
                                </p>
                            </div>

                            <div class="home-hero-card-footer">
                                <div class="home-hero-card-box"></div>
                                <div class="home-hero-card-box"></div>
                                <div class="home-hero-card-box"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</x-layout>