<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Get the other participant's name for the header --}}
                    @php
                        $otherParticipant = $conversation->participants->where('id', '!=', auth()->id())->first();
                    @endphp
                    <h2 class="text-2xl font-bold mb-4 border-b pb-4">
                        Conversation with {{ $otherParticipant->name }}
                    </h2>

                    {{-- Message History --}}
                    <div class="space-y-6">
                        @foreach ($conversation->messages as $message)
                            {{-- Determine styling based on who sent the message --}}
                            @if ($message->user_id === auth()->id())
                                {{-- Sent Message (Right-aligned) --}}
                                <div class="flex justify-end">
                                    <div class="bg-blue-500 text-white rounded-lg py-2 px-4 max-w-sm">
                                        {{ $message->body }}
                                        <div class="text-xs text-blue-200 mt-1 text-right">{{ $message->created_at->format('g:i A') }}</div>
                                    </div>
                                </div>
                            @else
                                {{-- Received Message (Left-aligned) --}}
                                <div class="flex justify-start">
                                    <div class="bg-gray-200 text-gray-800 rounded-lg py-2 px-4 max-w-sm">
                                        {{ $message->body }}
                                        <div class="text-xs text-gray-500 mt-1">{{ $message->created_at->format('g:i A') }}</div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    {{-- Send Message Form --}}
                    <div class="mt-6 pt-6 border-t">
                        <form action="{{ route('messages.store', $conversation) }}" method="POST">
                            @csrf
                            <div class="flex items-start space-x-3">
                                <textarea name="body" rows="3" class="flex-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Type your message..."></textarea>
                                <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                                    Send
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>