{{-- resources/views/messages/_conversation-list.blade.php --}}
<div class="p-4 border-b">
    <div class="relative">
        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
        <input type="text" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-full text-sm" placeholder="Search conversations...">
    </div>
</div>

<div class="divide-y">
    @forelse ($conversations as $conversation)
        @php
            // Get the other participant in the conversation
            $otherParticipant = $conversation->participants->first();
        @endphp
        <a href="{{ route('messages.show', $conversation) }}" class="block p-4 hover:bg-gray-50 @if(request()->route('conversation') && request()->route('conversation')->id == $conversation->id) bg-blue-50 @endif">
            <div class="flex items-start space-x-3">
                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($otherParticipant->name) }}" alt="Avatar">
                <div class="flex-1 overflow-hidden">
                    <div class="flex justify-between items-center">
                        <h3 class="font-semibold truncate">{{ $otherParticipant->name }}</h3>
                        @if($conversation->latestMessage)
                            <p class="text-xs text-gray-500">{{ $conversation->latestMessage->created_at->diffForHumans() }}</p>
                        @endif
                    </div>
                    @if($conversation->latestMessage)
                        <p class="text-sm text-gray-600 truncate">
                            @if ($conversation->latestMessage->user->id === auth()->id())
                                <span class="font-semibold">You:</span>
                            @endif
                            {{ $conversation->latestMessage->body }}
                        </p>
                    @endif
                </div>
            </div>
        </a>
    @empty
        <p class="p-4 text-sm text-gray-500">No conversations yet.</p>
    @endforelse
</div>