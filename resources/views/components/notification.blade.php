

@if (session('success') || session('error') || session('info'))
    @php
        $type = session('success') ? 'success' : (session('error') ? 'error' : 'info');
        $message = session('success') ?? session('error') ?? session('info');

        $bgColor = [
            'success' => 'bg-green-100 border-green-400 text-green-700',
            'error' => 'bg-red-100 border-red-400 text-red-700',
            'info' => 'bg-blue-100 border-blue-400 text-blue-700',
        ][$type];

        $icon = [
            'success' => 'fa-check-circle',
            'error' => 'fa-exclamation-triangle',
            'info' => 'fa-info-circle',
        ][$type];
    @endphp

    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 5000)"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-2"
         class="fixed top-24 left-1/2 -translate-x-1/2 z-50 p-4 border-l-4 rounded-md shadow-lg {{ $bgColor }}"
        role="alert"
    >
        <div class="flex">
            <div class="py-1"><i class="fas {{ $icon }} mr-3 text-xl"></i></div>
            <div>
                <p class="font-bold">{{ ucfirst($type) }}</p>
                <p class="text-sm">{{ $message }}</p>
            </div>
            <button @click="show = false" class="ml-4 -mt-1 -mr-1 text-xl">&times;</button>
        </div>
    </div>
@endif