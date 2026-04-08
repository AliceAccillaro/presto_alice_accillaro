<footer class="footer mt-5 py-3">
    <div class="container">

        <div class="row align-items-start">

            <div class="col-md-4 mb-2">
                <h6 class="fw-bold mb-1">{{ __('footer.title') }}</h6>
                <p class="text-muted small mb-0">
                    {{ __('footer.description') }}
                </p>
            </div>

            <div class="col-md-4 mb-2">
                <h6 class="fw-bold mb-1">{{ __('footer.usefulLinks') }}</h6>
                <ul class="list-unstyled mb-0 small">
                    <li><a href="{{ route('home') }}" class="footer-link">{{ __('footer.home') }}</a></li>
                    <li><a href="#" class="footer-link">{{ __('footer.categories') }}</a></li>
                    <li><a href="#" class="footer-link">{{ __('footer.contacts') }}</a></li>
                </ul>
            </div>

            <div class="col-md-4 mb-2">
                <h6 class="fw-bold mb-1">{{ __('footer.becomeRevisor') }}</h6>
                <p class="text-muted small mb-1">
                    {{ __('footer.revisorDescription') }}
                </p>

                @auth
                    <a href="{{ route('work.with.us') }}" class="btn footer-button">
                        {{ __('footer.revisorButton') }}
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn footer-button">
                        {{ __('footer.revisorButton') }}
                    </a>
                @endauth
            </div>

        </div>

        <hr class="my-2">

        <div class="text-center small text-muted">
            {{ __('footer.copyright') }}
        </div>

    </div>
</footer>