@props([
    'label' => null,
    'name' => null,
    'accept' => 'image/*',
    'preview' => true,
    'help' => null,
    'multiple' => false,
    'maxFiles' => 4,
])

@php
    $cleanName = str_replace(['[', ']'], '', $name);
    $inputName = $multiple ? (str_ends_with($name, '[]') ? $name : $name . '[]') : $name;
    $uniqueId = 'file_' . $cleanName . '_' . uniqid();
@endphp

<div class="mb-4" id="wrapper_{{ $uniqueId }}">
    @if($label)
        <label class="block text-sm font-medium text-gray-700 font-montserrat mb-1">
            {{ $label }}
            @if($multiple)
                <span class="text-xs text-gray-500">(Máximo {{ $maxFiles }} archivos)</span>
            @endif
        </label>
    @endif

    <!-- Input oculto -->
    <input 
        id="{{ $uniqueId }}"
        type="file" 
        name="{{ $inputName }}"
        accept="{{ $accept }}"
        @if($multiple) multiple @endif
        class="hidden"
        {{ $attributes->except(['class']) }}>

    <!-- Botones -->
    <div class="flex items-center gap-3 mb-3">
        <button 
            type="button" 
            id="btn_{{ $uniqueId }}"
            class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Agregar archivos
        </button>
        
        <button 
            type="button"
            id="btn_clear_{{ $uniqueId }}"
            style="display: none;"
            class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
            Eliminar todos
        </button>
    </div>

    <!-- Lista de archivos -->
    <div id="files_list_{{ $uniqueId }}" style="display: none;" class="mt-2">
        <p class="text-xs text-gray-500 mb-2">
            <span id="files_count_{{ $uniqueId }}">0</span> archivo(s) seleccionado(s)
        </p>
        <div id="files_container_{{ $uniqueId }}" class="space-y-2"></div>
    </div>

    @if($preview)
        <!-- Vista previa -->
        <div id="preview_{{ $uniqueId }}" style="display: none;" class="mt-4">
            <h4 class="text-sm font-medium text-gray-700 mb-3">Vista previa</h4>
            <div id="preview_container_{{ $uniqueId }}" class="grid grid-cols-2 md:grid-cols-4 gap-4"></div>
        </div>
    @endif

    @if($help)
        <p class="mt-1 text-xs text-gray-500">{{ $help }}</p>
    @endif

    @error($cleanName)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<script>
(function() {
    const uniqueId = '{{ $uniqueId }}';
    const maxFiles = {{ $multiple ? $maxFiles : 1 }};
    const isMultiple = {{ $multiple ? 'true' : 'false' }};
    const hasPreview = {{ $preview ? 'true' : 'false' }};
    
    let files = [];
    let previews = [];
    let isProcessing = false;
    
    const input = document.getElementById(uniqueId);
    const btn = document.getElementById('btn_' + uniqueId);
    const btnClear = document.getElementById('btn_clear_' + uniqueId);
    const filesList = document.getElementById('files_list_' + uniqueId);
    const filesContainer = document.getElementById('files_container_' + uniqueId);
    const filesCount = document.getElementById('files_count_' + uniqueId);
    const previewDiv = document.getElementById('preview_' + uniqueId);
    const previewContainer = document.getElementById('preview_container_' + uniqueId);
    
    // Event listener para el botón - SOLO UNA VEZ
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        if (isProcessing) {
            console.log('Already processing, ignoring click');
            return;
        }
        
        console.log('Opening file dialog');
        input.click();
    }, { once: false });
    
    // Event listener para el input - SOLO UNA VEZ
    input.addEventListener('change', function(e) {
        if (isProcessing) {
            console.log('Already processing files, ignoring change event');
            return;
        }
        
        isProcessing = true;
        console.log('Processing files...');
        
        if (!input.files || input.files.length === 0) {
            isProcessing = false;
            return;
        }
        
        const selectedFiles = Array.from(input.files);
        console.log('Selected files:', selectedFiles.length);
        
        // Verificar límite
        if (files.length + selectedFiles.length > maxFiles) {
            alert(`Máximo ${maxFiles} archivos permitidos`);
            input.value = '';
            isProcessing = false;
            return;
        }
        
        // Agregar archivos
        selectedFiles.forEach(file => {
            files.push(file);
            
            if (hasPreview) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previews.push(e.target.result);
                    updateUI();
                };
                reader.readAsDataURL(file);
            }
        });
        
        if (isMultiple) {
            // Actualizar el input con todos los archivos
            const dt = new DataTransfer();
            files.forEach(file => dt.items.add(file));
            input.files = dt.files;
        }
        
        updateUI();
        
        setTimeout(() => {
            isProcessing = false;
            console.log('Processing complete');
        }, 200);
    }, { once: false });
    
    // Botón limpiar
    btnClear.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        clearAll();
    });
    
    function removeFile(index) {
        files.splice(index, 1);
        previews.splice(index, 1);
        
        if (isMultiple) {
            const dt = new DataTransfer();
            files.forEach(file => dt.items.add(file));
            input.files = dt.files;
        } else {
            input.value = '';
        }
        
        updateUI();
    }
    
    function clearAll() {
        files = [];
        previews = [];
        input.value = '';
        updateUI();
    }
    
    function updateUI() {
        // Actualizar contador
        filesCount.textContent = files.length;
        
        // Mostrar/ocultar elementos
        filesList.style.display = files.length > 0 ? 'block' : 'none';
        btnClear.style.display = files.length > 0 ? 'inline-flex' : 'none';
        
        if (hasPreview) {
            previewDiv.style.display = previews.length > 0 ? 'block' : 'none';
        }
        
        // Actualizar lista de archivos
        filesContainer.innerHTML = '';
        files.forEach((file, index) => {
            const fileDiv = document.createElement('div');
            fileDiv.className = 'flex items-center justify-between text-sm text-gray-700 bg-gray-50 p-3 rounded-lg border';
            fileDiv.innerHTML = `
                <div class="flex items-center space-x-3 flex-1 min-w-0">
                    <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium truncate">${file.name}</p>
                        <p class="text-xs text-gray-500">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                    </div>
                </div>
                ${isMultiple ? `
                <button type="button" onclick="window.removeFile_${uniqueId}(${index})" class="ml-3 inline-flex items-center px-3 py-1 bg-red-100 hover:bg-red-200 text-red-700 text-xs font-medium rounded-md transition-colors duration-200">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Eliminar
                </button>
                ` : ''}
            `;
            filesContainer.appendChild(fileDiv);
        });
        
        // Actualizar previews
        if (hasPreview && previewContainer) {
            previewContainer.innerHTML = '';
            previews.forEach((preview, index) => {
                const previewDiv = document.createElement('div');
                previewDiv.className = 'relative group';
                previewDiv.innerHTML = `
                    <img src="${preview}" alt="preview" class="h-32 w-full object-cover rounded-lg border-2 border-gray-200 hover:border-gray-300 transition-colors" />
                    ${isMultiple ? `
                    <button type="button" onclick="window.removeFile_${uniqueId}(${index})" class="absolute -top-2 -right-2 bg-red-500 hover:bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold transition-colors duration-200 opacity-0 group-hover:opacity-100">
                        ×
                    </button>
                    ` : ''}
                    <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-xs p-2 rounded-b-lg">
                        <p class="truncate">${files[index]?.name || ''}</p>
                    </div>
                `;
                previewContainer.appendChild(previewDiv);
            });
        }
    }
    
    // Exponer función para eliminar
    window['removeFile_' + uniqueId] = removeFile;
})();
</script>