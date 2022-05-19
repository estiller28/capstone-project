<x-app-layout>

    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if(session('error'))
            <div class="alert alert-danger">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{session('error')}}
            </div>
        @endif
        <div class="text-center fs-4 mb-4">Register as Citizen</div>
        <form method="POST" action="{{ route('register.citizen') }}">
            @csrf
            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('First Name') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required />
            </div>
            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Last Name') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required />
            </div>


            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>

</x-app-layout>
