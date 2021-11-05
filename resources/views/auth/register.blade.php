<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/" class="d-flex justify-content-center mb-4">
                <x-application-logo width=64 height=64 />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Company Email')" />

                <x-input id="email" class="" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class=""
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class=""
                                type="password"
                                name="password_confirmation" required />
            </div>
            <div class="d-flex justify-content-center mt-4">
                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <div>
                    <input id="terms" class="" type="checkbox" name="terms" required />
                         <a target="_blank" class="text-muted" href="{{ route('terms.condition') }}" style="margin-right: 15px; margin-top: 15px;">
                            {{ __('I Accept the Terms and Conditions') }}
                        </a>

                </div>
                <div>
                    <a class="text-muted" href="{{ route('login') }}" style="margin-right: 15px; margin-top: 15px;">
                        {{ __('Already registered?') }}
                    </a>

                </div>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
