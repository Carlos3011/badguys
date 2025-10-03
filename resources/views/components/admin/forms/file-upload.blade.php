@props([
    'label' => null,
    'name' => null,
    'accept' => 'image/*',
    'preview' => true,
    'help' => null,
])

<div class="mb-4" x-data="{ fileName: '', previewUrl: '' }">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 font-montserrat mb-1">{{ $label }}</label>
    @endif

    <div class="flex items-center gap-3">
        <input id="{{ $name }}" name="{{ $name }}" type="file" accept="{{ $accept }}"
               @change="fileName = $event.target.files[0]?.name || ''; if({{ $preview ? 'true' : 'false' }}) { const f=$event.target.files[0]; if(f){ const r=new FileReader(); r.onload=()=>previewUrl=r.result; r.readAsDataURL(f);} }"
               {{ $attributes->merge(['class' => 'block w-full rounded-md border-gray-300 shadow-sm focus:border-black focus:ring-black font-montserrat']) }}>
    </div>

    <template x-if="fileName">
        <p class="mt-1 text-xs text-gray-500">Seleccionado: <span class="font-semibold" x-text="fileName"></span></p>
    </template>

    @if($preview)
        <template x-if="previewUrl">
            <div class="mt-2">
                <img :src="previewUrl" alt="preview" class="h-24 w-24 object-cover rounded-md border" />
            </div>
        </template>
    @endif

    @if($help)
        <p class="mt-1 text-xs text-gray-500">{{ $help }}</p>
    @endif

    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>