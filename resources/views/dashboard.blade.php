<x-app-layout>
    <div class="min-h-screen bg-gray-100">
        <nav x-data="{ open: false }" class="bg-white shadow border-b border-gray-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <h2 class="text-center text-3xl font-extrabold text-gray-900">
                                <b class="text-amber-600">
                                    {{ trans('My') }}
                                </b>
                                {{ trans('Process') }}
                            </h2>
                        </div>
                    </div>

                    <div class="ml-4 flex items-center md:ml-6">
                        <x-dropdown>
                            <button type="button"
                                class="p-2 max-w-xs bg-white rounded-md flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-600 hover:bg-gray-100">
                                <span class="ml-3 text-gray-700 text-sm font-medium">
                                    <i class="fa-solid fa-user fa-xl"></i>
                                </span>
                                <i class="fa-solid fa-angle-down fa-lg ml-2 text-gray-400"></i>
                            </button>
                            <x-slot name="infos">
                                <x-dropdown.info title="{!! user()->name !!}" />
                            </x-slot>
                            <x-slot name="links">
                                <form method="post" action="{{ route('logout', null, false) }}">
                                    @csrf
                                    <x-dropdown.button title="{{ trans('Log out') }}" icon="fa fa-sign-out-alt" />
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </div>
        </nav>

        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ trans('Dashboard') }}
                </h2>
            </div>
        </header>

        <main>
            <div class="py-12">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="space-y-6">
                        {{-- Redirect Horizon --}}
                        <x-button href="{{ url('/horizon') }}" size="3xl" color="purple"
                            class="w-full justify-center" target="__blank">
                            Horizon
                        </x-button>

                        {{-- Redirect Telescope --}}
                        <x-button href="{{ url('telescope') }}" size="3xl" color="cyan"
                            class="w-full justify-center" target="__blank">
                            Telescope
                        </x-button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
