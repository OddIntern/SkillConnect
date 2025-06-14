<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="flex border-t" style="height: calc(100vh - 10rem);">

                {{-- Left Pane: Conversation List --}}
                <div class="w-full sm:w-1/3 md:w-1/4 border-r overflow-y-auto">
                    @yield('conversation-list')
                </div>

                {{-- Right Pane: Selected Conversation --}}
                <div class="flex-1 flex flex-col">
                    @yield('conversation-content')
                </div>

            </div>
        </div>
    </div>
</x-app-layout>