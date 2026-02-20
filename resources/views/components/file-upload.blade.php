@props([
    'name' => ''
    
    ])


<div class=" flex flex-col justify-center items-center w-full max-w-xl">
    <div
        class="max-w-md w-full p-6 bg-white rounded-lg border border-gray-500/30 shadow-[0px_1px_15px_0px] shadow-black/10 text-sm">

        <label for="fileInput" id="dropZone"
            class="border-2 border-dotted border-gray-400 p-8 mt-2 flex flex-col items-center gap-4 cursor-pointer hover:border-blue-500 transition">
            <svg width="31" height="31" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M18.085 2.583H7.75a2.583 2.583 0 0 0-2.583 2.584v20.666a2.583 2.583 0 0 0 2.583 2.584h15.5a2.583 2.583 0 0 0 2.584-2.584v-15.5m-7.75-7.75 7.75 7.75m-7.75-7.75v7.75h7.75M15.5 23.25V15.5m-3.875 3.875h7.75"
                    stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <p class="text-gray-500 text-center">Drag files here or <span class="text-blue-500 underline">click to
                    select</span></p>
            <input id="fileInput" type="file" class="hidden" multiple accept="image/*" name="{{ $name }}"/>
        </label>

        <ul id="fileListContainer" class="mt-4 space-y-2">
        </ul>

    
    </div>
</div>

<script>
    const fileInput = document.getElementById('fileInput');
    const fileListContainer = document.getElementById('fileListContainer');

    fileInput.addEventListener('change', (event) => {
        const files = Array.from(event.target.files);

        files.forEach((file, index) => {
            const li = document.createElement('li');
            li.className = "flex items-center justify-between p-3 bg-white border border-slate-200 rounded-lg shadow-sm hover:border-blue-400 transition-colors group";

            li.innerHTML = `
                <div class="flex items-center space-x-3 overflow-hidden">
                    <svg class="w-5 h-5 text-slate-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="text-sm font-medium text-slate-700 truncate">${file.name}</span>
                </div>
                <button type="button" class="remove-btn text-slate-400 hover:text-red-500 transition-colors p-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            `;

            li.querySelector('.remove-btn').addEventListener('click', () => {
                li.remove();
            });

            fileListContainer.appendChild(li);
        });
    });
</script>