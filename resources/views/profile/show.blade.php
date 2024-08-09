<x-app-layout>
    <x-slot name="header">
        @if (auth()->user()->role == 1)
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Company Profile') }}
            </h2>
            <a class="font-semibold text-xl text-gray-800 leading-tight hover:text-red-600" href="/company">
                {{ __('Back to Dashboard') }}
            </a>
        @elseif (auth()->user()->role == 2 && auth()->user()->career_role != 1)
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Employee Profile') }}
            </h2>
            <a class="font-semibold text-xl text-gray-800 leading-tight hover:text-red-600" href="/employee">
                {{ __('Back to Dashboard') }}
            </a>
        @else
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Project Manager Profile') }}
            </h2>
            <a class="font-semibold text-xl text-gray-800 leading-tight hover:text-red-600" href="/project-manager">
                {{ __('Back to Dashboard') }}
            </a>
        @endif

    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-section-border/>
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-section-border/>
            @endif

            {{--            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())--}}
            {{--                <div class="mt-10 sm:mt-0">--}}
            {{--                    @livewire('profile.two-factor-authentication-form')--}}
            {{--                </div>--}}

            {{--                <x-section-border />--}}
            {{--            @endif--}}

            {{--            <div class="mt-10 sm:mt-0">--}}
            {{--                @livewire('profile.logout-other-browser-sessions-form')--}}
            {{--            </div>--}}

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                {{--                <x-section-border />--}}

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
