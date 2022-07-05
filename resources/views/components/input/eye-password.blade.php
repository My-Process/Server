<div class="absolute mt-1 inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
    <div x-on:click="showEyes = !showEyes" :class="{ 'hidden': !showEyes, 'block': showEyes, 'cursor-pointer': true }">
        <i class="fas fa-eye-slash fa-lg text-gray-700"></i>
    </div>
    <div x-on:click="showEyes = !showEyes" :class="{ 'block': !showEyes, 'hidden': showEyes, 'cursor-pointer': true }">
        <i class="fas fa-eye fa-lg text-gray-700"></i>
    </div>
</div>
