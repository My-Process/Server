<x-app-layout>
    <div class="min-h-full px-4 py-16 sm:px-6 sm:py-24 md:grid md:place-items-center lg:px-8">
        <div class="max-w-max mx-auto">
            <main class="sm:flex">
                <p class="text-4xl font-extrabold text-amber-600 sm:text-5xl">
                    419
                </p>
                <div class="sm:ml-6">
                    <div class="sm:border-l sm:border-gray-700 sm:pl-6">
                        <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight sm:text-5xl">
                            {{ __('errors.page-expired') }}
                        </h1>
                        <p class="mt-1 text-base text-gray-500">
                            {{ __('errors.page-expired-text') }}
                        </p>
                    </div>
                    <div class="mt-10 flex space-x-3 sm:border-l sm:border-transparent sm:pl-6">
                        <x-button href="{{ route('dashboard') }}" outline>
                            {{ __('errors.home-page') }}
                        </x-button>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
