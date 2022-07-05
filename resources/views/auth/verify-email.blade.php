<x-app-layout>
    <div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                <b class="text-amber-600">{{ __('My') }}</b>&nbsp{{ __('Process') }}
            </h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="text-center bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <div class="mb-4 text-sm text-gray-600">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </div>
                <form method="post" action="{{ route('logout') }}">
                    @csrf
                    <x-button class="w-full justify-center" type="submit" outline>
                        {{ __('Log Out') }}
                    </x-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
