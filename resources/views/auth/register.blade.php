<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo/>
        </x-slot>

        <x-validation-errors class="mb-4"/>

        <form method="POST" action="{{ route('register') }}" x-data="{role: 1, career_role: 1}">
            @csrf

            <div>
                <x-label for="role" value="{{ __('Register as:') }}"/>
                <select name="role" id="role_id" x-model="role"
                        class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="1">Company</option>
                    <option value="2">Employee</option>
                </select>
            </div>

            @php
                $companies = \Illuminate\Support\Facades\DB::table('users')->where('role', 1)->get();
//            dd($companies)
            @endphp

            <template x-if="role == 2">
                <div class="mt-4">
                    <x-label for="selected_company" value="{{ __('Select Company') }}"/>
                    <select name="selected_company" id="selected_company" x-model="selected_company"
                            class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>
            </template>

            <template x-if="role == 1">
                <div class="mt-4">
                    <x-label for="name" value="{{ __('Company Name') }}"/>
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                             :value="old('name')" autofocus required/>
                </div>
            </template>

            <template x-if="role == 1">
                <div class="mt-4">
                    <x-label for="email" value="{{ __('Company Email') }}"/>
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                             :value="old('email')" autofocus required/>
                </div>
            </template>

            <template x-if="role == 2">
                <div class="mt-4">
                    <x-label for="name" value="{{ __('Employee Name') }}"/>
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                             autofocus/>
                </div>
            </template>

            <template x-if="role == 2">
                <div class="mt-4">
                    <x-label for="nic" value="{{ __('National Identity Card') }}"/>
                    <x-input id="nic" class="block mt-1 w-full" type="text" name="nic" :value="old('nic')" required
                             autofocus/>
                </div>
            </template>

            <template x-if="role == 2">
                <div class="mt-4">
                    <x-label for="eid" value="{{ __('Employee ID') }}"/>
                    <x-input id="eid" class="block mt-1 w-full" type="text" name="eid"
                             :value="old('eid')" autofocus required/>
                </div>
            </template>

            <template x-if="role == 2">
                <div class="mt-4">
                    <x-label for="career_role" value="{{ __('Employee Role') }}"/>
                    <select name="career_role" id="career_role" x-model="career_role"
                            class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <option value="1">Project Manager</option>
                        <option value="2">Business Analyst</option>
                        <option value="3">UI/UX Designer</option>
                        <option value="4">Software Engineer</option>
                        <option value="5">Web Developer</option>
                        <option value="6">Quality Assurance Engineer</option>


                        {{--                        <option value="6">DevOps Engineer</option>--}}
                        {{--                        <option value="7">Database Administrator</option>--}}
                        {{--                        <option value="8">Network Administrator</option>--}}
                        {{--                        <option value="9">System Administrator</option>--}}
                        {{--                        <option value="10">Security Engineer</option>--}}
                        {{--                        <option value="11">Technical Support Engineer</option>--}}
                        {{--                        <option value="12">Data Scientist</option>--}}
                        {{--                        <option value="13">Machine Learning Engineer</option>--}}
                        {{--                        <option value="14">AI Engineer</option>--}}
                        {{--                        <option value="15">Cloud Engineer</option>--}}
                        {{--                        <option value="16">IT Manager</option>--}}
                        {{--                        <option value="17">IT Director</option>--}}
                        {{--                        <option value="18">Chief Technology Officer</option>--}}
                        {{--                        <option value="19">Chief Information Officer</option>--}}
                        {{--                        <option value="20">Chief Information Security Officer</option>--}}


                    </select>
                </div>
            </template>


            <template x-if="role == 2">
                <div class="mt-4">
                    <x-label for="email" value="{{ __('Work Email') }}"/>
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                             :value="old('email')" autofocus required/>
                </div>
            </template>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}"/>
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required/>
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}"/>
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                         name="password_confirmation" required/>
            </div>


            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required/>

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                   href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
