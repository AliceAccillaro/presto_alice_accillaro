<x-layout>
    <section class="auth-section">
        <div class="container">
            <div class="row justify-content-center align-items-center auth-row">
                <div class="col-12 col-md-6 col-lg-5">
                    <div class="auth-card">

                        <div class="auth-header">
                            <h1 class="auth-title">{{ __('auth.login_title') }}</h1>
                            <p class="auth-subtitle">
                                {{ __('auth.login_subtitle') }}
                            </p>
                        </div>

                        <form method="POST" action="{{ route('login') }}" class="auth-form">
                            @csrf

                            <div class="mb-3">
                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="{{ __('auth.email') }}"
                                    value="{{ old('email') }}"
                                    required
                                >
                            </div>

                            <div class="mb-3">
                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="{{ __('auth.password_label') }}"
                                    required
                                >
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    {{ $errors->first() }}
                                </div>
                            @endif

                            <button type="submit" class="home-button home-button-primary w-100">
                                {{ __('auth.login_button') }}
                            </button>
                        </form>

                        <div class="auth-footer">
                            <p>
                                {{ __('auth.no_account') }}
                                <a href="{{ route('register') }}">{{ __('auth.register_link') }}</a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
