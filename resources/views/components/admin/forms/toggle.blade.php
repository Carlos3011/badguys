@props([
    'label' => null,
    'name' => null,
    'checked' => false,
    'help' => null,
])

<div class="mb-4" x-data="{ on: {{ old($name, $checked) ? 'true' : 'false' }} }">
    @if($label)
        <span class="block text-sm font-medium text-gray-700 font-montserrat mb-1">{{ $label }}</span>
    @endif

    <button type="button" @click="on = !on" :aria-pressed="on" class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none" :class="on ? 'bg-black' : 'bg-gray-300'">
        <span class="inline-block h-5 w-5 transform rounded-full bg-white transition" :class="on ? 'translate-x-5' : 'translate-x-1'"></span>
    </button>
    <input type="hidden" name="{{ $name }}" :value="on ? 1 : 0" />

    @if($help)
        <p class="mt-1 text-xs text-gray-500">{{ $help }}</p>
    @endif

    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>