<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Users taula aldatu da beraz parte hau aldatu beharra dago: -->
        <!-- IADA EZ DA Name ERABILIKO EZ BAIT DAGO GURE DATU BASEAN. -->
        <!-- <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div> -->
         <!-- ORAIN HAUEK BEHAR DIRA: -->
        <!-- ************************************************************** -->
        <!-- user_izena -->
        <div>
            <x-input-label for="user_izena" :value="__('User Izena')" />
            <x-text-input id="user_izena" name="user_izena" type="text" class="mt-1 block w-full" :value="old('user_izena', $user->user_izena)" required autofocus autocomplete="user_izena" />
            <x-input-error class="mt-2" :messages="$errors->get('user_izena')" />
        </div>
        <!-- izena -->
        <div>
            <x-input-label for="izena" :value="__('Izena')" />
            <x-text-input id="izena" name="izena" type="text" class="mt-1 block w-full" :value="old('izena', $user->izena)" required autofocus autocomplete="izena" />
            <x-input-error class="mt-2" :messages="$errors->get('izena')" />
        </div>
        <!-- abizena -->
        <div>
            <x-input-label for="abizena" :value="__('Abizena')" />
            <x-text-input id="abizena" name="abizena" type="text" class="mt-1 block w-full" :value="old('abizena', $user->abizena)" required autofocus autocomplete="abizena" />
            <x-input-error class="mt-2" :messages="$errors->get('abizena')" />
        </div>
        <!-- nan -->
        <div>
            <x-input-label for="nan" :value="__('NAN')" />
            <x-text-input id="nan" name="nan" type="text" class="mt-1 block w-full" :value="old('nan', $user->nan)"  autofocus autocomplete="nan" />
            <x-input-error class="mt-2" :messages="$errors->get('nan')" />
        </div>
        <!-- ************************************************************** -->

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
