<x-guest-layout>
    <!-- Session Status -->
    <div class="card p-lg-5 shadow text-center  ">
        <h3>log in</h3>
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email Address -->
            <div class="mb-3">
                <x-input-label for="email" :value="__('Email adres')" />
                <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <!-- Password -->
            <div class="mb-3">
                <x-input-label for="password" :value="__('Wachtwoord')" />
                <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div class="d-flex flex-column align-items-center mt-4">
                <a class="text-decoration-underline text-sm text-gray-600" href="{{ route('register') }}">
                    {{__('Aanmelden')}}
                </a>
                @if (Route::has('password.request'))
                <a class="text-decoration-underline text-sm text-gray-600" href="{{ route('password.request') }}">
                    {{ __('wachtwoord vergeten?') }}
                </a>
                @endif
                <x-primary-button class="mt-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
