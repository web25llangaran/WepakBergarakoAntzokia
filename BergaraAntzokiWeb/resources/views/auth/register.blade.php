<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- IADA EZ DA Name ERABILIKO EZ BAIT DAGO GURE DATU BASEAN. -->
        <!-- Name -->
        <!-- <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div> -->

        <!-- ORAIN HAUEK BEHAR DIRA: -->
        <!-- ************************************************************** -->
        <!-- user_izena -->
        <div>
            <x-input-label for="user_izena" :value="__('User izena')" />
            <x-text-input id="user_izena" class="block mt-1 w-full" type="text" name="user_izena" :value="old('user_izena')" required autofocus autocomplete="user_izena" />
            <x-input-error :messages="$errors->get('user_izena')" class="mt-2" />
        </div>

         <!-- izena -->
        <div>
            <x-input-label for="izena" :value="__('Izena')" />
            <x-text-input id="izena" class="block mt-1 w-full" type="text" name="izena" :value="old('izena')" required autofocus autocomplete="izena" />
            <x-input-error :messages="$errors->get('izena')" class="mt-2" />
        </div>

        <!-- abizena -->
        <div>
            <x-input-label for="abizena" :value="__('Abizena')" />
            <x-text-input id="abizena" class="block mt-1 w-full" type="text" name="abizena" :value="old('abizena')" required autofocus autocomplete="abizena" />
            <x-input-error :messages="$errors->get('abizena')" class="mt-2" />
        </div>

        <!-- nan -->
        <div>
            <x-input-label for="nan" :value="__('NAN')" />
            <x-text-input id="nan" class="block mt-1 w-full" type="text" name="nan" :value="old('nan')" autofocus autocomplete="nan" />
            <x-input-error :messages="$errors->get('nan')" class="mt-2" />
        </div>
        <!-- ************************************************************** -->

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
