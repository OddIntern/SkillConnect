<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SkillConnect') }} - Connect Through Volunteering</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- This is the new placeholder for page-specific CSS files --}}
    {{ $styles ?? '' }}

</head>
<body x-data="{ 
    openModal: null,
    async openCreatePostModal() {
        let response = await fetch('{{ route('projects.create') }}');
        this.$refs.createPostModalContent.innerHTML = await response.text();
        this.openModal = 'createProject';
    },

    async openProjectModal(projectId) {
        let url = `/projects/${projectId}`;
        let response = await fetch(url);
        this.$refs.projectModalContent.innerHTML = await response.text();
        this.openModal = 'projectDetails';
    }

}" class="font-sans antialiased">

    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <main>
            {{ $slot }}
        </main>

        @include('layouts.footer')
    </div>
    
    {{-- This is the new placeholder for page-specific JS files --}}
    {{ $scripts ?? '' }}

    <div 
    x-show="openModal === 'createProject'" 
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
    style="display: none;"
>
    <div @click.away="openModal = null" class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        {{-- This div is the target for our fetched content. It has a spinner for loading. --}}
            <div x-ref="createPostModalContent" class="flex items-center justify-center min-h-[400px]">
                <i class="fas fa-spinner fa-spin text-4xl text-gray-400"></i>
            </div>
        </div>
    </div>

    <div 
    x-show="openModal === 'projectDetails'" 
    x-transition 
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
    style="display: none;"
    @keydown.escape.window="openModal = null"
>
    <div @click.away="openModal = null" class="bg-white rounded-lg shadow-xl w-full max-w-3xl max-h-[90vh] flex flex-col">
        {{-- The fetched project details and comments will be injected here --}}
        <div x-ref="projectModalContent" class="overflow-y-auto">
            {{-- Loading Spinner --}}
            <div class="flex items-center justify-center min-h-[400px]">
                 <i class="fas fa-spinner fa-spin text-4xl text-gray-400"></i>
            </div>
        </div>
    </div>
</div>
</body>
</html>