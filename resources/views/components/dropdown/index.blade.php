<div class="z-10">
    <div class="ml-4 flex items-center md:ml-6">
        <div class="flex items-center space-x-1 group">
            <div class="relative ml-2 inline-block text-left" x-data="{ open: false }" x-on:click.away="open = false"
                x-on:close.stop="open = false">
                <div x-on:click="open = !open">
                    {{ $slot }}
                </div>
                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none"
                    style="display: none;" x-on:click="open = false">
                    <div class="px-4 py-3" role="none">
                        {{ $infos }}
                    </div>
                    <div class="py-1" role="none">
                        {{ $links }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
