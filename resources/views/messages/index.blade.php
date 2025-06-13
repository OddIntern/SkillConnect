<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-6">Inbox</h2>

                    <div class="space-y-4">
                        @forelse ($conversations as $conversation)
                            {{-- We will add a link to the conversation later --}}
                            <a href="{{ route('messages.show', $conversation) }}" class="block hover:bg-gray-50 p-4 rounded-lg border">
                                <div class="flex items-start space-x-4">
                                    {{-- Avatar of the other participant --}}
                                    <img class="h-12 w-12 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($conversation->participants->first()->name) }}" alt="Avatar">

                                    <div class="flex-1">
                                        <div class="flex justify-between">
                                            {{-- Name of the other participant --}}
                                            <h3 class="font-bold">{{ $conversation->participants->first()->name }}</h3>
                                            {{-- Timestamp of the latest message --}}
                                            <p class="text-xs text-gray-500">{{ $conversation->latestMessage->created_at->diffForHumans() }}</p>
                                        </div>

                                        {{-- Latest message preview --}}
                                        @if ($conversation->latestMessage)
                                            <p class="text-sm text-gray-600 mt-1">
                                                {{-- Show "You:" if you sent the last message --}}
                                                @if ($conversation->latestMessage->user->id === auth()->id())
                                                    <span class="font-semibold">You:</span>
                                                @endif
                                                {{ Str::limit($conversation->latestMessage->body, 50) }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </a>
                            @empty
                                <div class="text-center py-12">
                                    <i class="fas fa-comments text-5xl text-gray-300 mb-4"></i>
                                    <h3 class="text-lg font-semibold text-gray-800">No Conversations Yet</h3>
                                    <p class="text-gray-500 mt-2 max-w-sm mx-auto">
                                        This is your inbox. When you start a conversation with another user, it will appear here.
                                    </p>
                                    <p class="text-gray-500 mt-1 max-w-sm mx-auto">
                                        To begin, find a user's profile and click the 'Message' button.
                                    </p>
                                </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>