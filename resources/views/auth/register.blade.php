<x-layout>
    <section class="auth-section">
        <div class="container">
            <div class="row justify-content-center align-items-center auth-row">

                <div class="col-12 col-md-6 col-lg-5">
                    <div class="auth-card">

                        <div class="auth-header">
                            <h1 class="auth-title">{{ __('auth.register_title') }}</h1>
                            <p class="auth-subtitle">
                                {{ __('auth.register_subtitle') }}
                            </p>
                        </div>

                        <form method="POST" action="{{ route('register') }}" class="auth-form">
                            @csrf

                            <div class="mb-3">
                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    placeholder="{{ __('auth.name') }}"
                                    value="{{ old('name') }}"
                                    required
                                >
                            </div>

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

                            <div class="mb-3">
                                <input
                                    type="password"
                                    name="password_confirmation"
                                    class="form-control"
                                    placeholder="{{ __('auth.password_confirmation') }}"
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
                                {{ __('auth.register_button') }}
                            </button>
                        </form>

                        <div class="auth-footer">
                            <p>
                                {{ __('auth.already_account') }}
                                <a href="{{ route('login') }}">{{ __('auth.login_link') }}</a>
                            </p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
</x-layout>
