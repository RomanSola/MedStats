<x-guest-layout>
    <!-- Card principal (contenido del login) -->
    <div class="relative w-full max-w-md bg-white rounded-2xl shadow-xl overflow-hidden z-10">

        <!-- Header: Logo y título -->
        <div class="bg-[#1B7D8F] flex flex-col items-center justify-center p-6">
            <img src="{{ asset('assets/img/logo-san-felipe.png') }}" alt="Logo Hospital" class="w-28 h-28 mb-2">
            <h1 class="text-2xl font-bold text-white">Hospital San Felipe</h1>
            <p class="text-white/80 mt-1 text-center text-sm">Bienvenido al sistema de gestión hospitalaria</p>
        </div>

        <!-- Formulario -->
        <div class="p-8 space-y-6">

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div class="space-y-1">
                    <x-input-label for="email" :value="'Email'" class="text-gray-700" />
                    <x-text-input id="email"
                        class="block mt-1 w-full rounded-xl border-gray-300 focus:border-[#1B7D8F] focus:ring-[#1B7D8F] shadow-sm transition-all duration-300"
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Password -->
                <div class="space-y-1">
                    <x-input-label for="password" :value="'Contraseña'" class="text-gray-700" />
                    <x-text-input id="password"
                        class="block mt-1 w-full rounded-xl border-gray-300 focus:border-[#1B7D8F] focus:ring-[#1B7D8F] shadow-sm transition-all duration-300"
                        type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Remember Me y Forgot Password -->
                <div class="flex items-center justify-between mt-2">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-300 text-[#1B7D8F] shadow-sm focus:ring-[#1B7D8F]"
                            name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Recordar registro') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-[#1B7D8F] hover:text-[#176d7b] transition-colors"
                            href="{{ route('password.request') }}">
                            {{ __('¿Olvidaste tu contraseña?') }}
                        </a>
                    @endif
                </div>

                <!-- Botón Login -->
                <div class="mt-4">
                    <x-primary-button
                        class="w-full py-3 text-lg font-semibold rounded-xl bg-[#1B7D8F] hover:bg-[#176d7b] transition-all duration-300 text-white shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        {{ __('Iniciar sesión') }}
                    </x-primary-button>
                </div>

                <div class="flex justify-center mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('register') }}">
                        {{ __('Crear Cuenta') }}
                    </a>
                </div>
            </form>

            <!-- Footer -->
            <p class="mt-6 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} Hospital San Felipe. Todos los derechos reservados.
            </p>
        </div>
    </div>
    </div>
</x-guest-layout>