<footer class="footer mt-5 py-3">
    <div class="container">

        <div class="row align-items-start">

            <div class="col-md-4 mb-2">
                <h6 class="fw-bold mb-1">Presto.it</h6>
                <p class="text-muted small mb-0">
                    Compra e vendi in modo semplice e veloce.
                </p>
            </div>

            <div class="col-md-4 mb-2">
                <h6 class="fw-bold mb-1">Link utili</h6>
                <ul class="list-unstyled mb-0 small">
                    <li><a href="{{ route('home') }}" class="footer-link">Home</a></li>
                    <li><a href="#" class="footer-link">Categorie</a></li>
                    <li><a href="#" class="footer-link">Contatti</a></li>
                </ul>
            </div>

            <div class="col-md-4 mb-2">
                <h6 class="fw-bold mb-1">Diventa revisore</h6>
                <p class="text-muted small mb-1">
                    Aiutaci a moderare gli articoli
                </p>
                <a href="{{ route('become.revisor') }}" class="btn footer-button">
                    Diventa Revisore
                </a>
            </div>

        </div>

        <hr class="my-2">

        <div class="text-center small text-muted">
            &copy; 2026 Presto.it
        </div>

    </div>
</footer>