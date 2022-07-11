<x-app-layout>
    <div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                <b class="text-amber-600">
                    {{ trans('My') }}
                </b>
                {{ trans('Process') }}
            </h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="text-center bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <div class="mb-4 text-sm text-gray-600">
                    {{ trans('Verify Email Message') }}
                </div>
                <form method="post" action="{{ route('logout') }}">
                    @csrf
                    <x-button class="w-full justify-center" type="submit" outline>
                        {{ trans('Log out') }}
                    </x-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
