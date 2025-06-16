@extends('layouts.messaging')



{{-- Left Pane: The list of all conversations --}}
@section('conversation-list')
    @include('messages._conversation-list', ['conversations' => $conversations])
@endsection

{{-- Right Pane: The selected conversation's content --}}
@section('conversation-content')
    @php
        // FIX #1: Filter the participants to find the user who is NOT the logged-in user.
        $otherParticipant = $selectedConversation->participants->where('id', '!=', auth()->id())->first();
    @endphp

    {{-- Header for the right pane --}}
    <div class="p-4 border-b flex items-center justify-between">
        @if ($otherParticipant)
            <a href="{{ route('profile.show', $otherParticipant) }}" class="flex items-center space-x-3 hover:bg-gray-100 p-2 rounded-lg transition">
                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($otherParticipant->name) }}" alt="Avatar">
                <h3 class="font-bold text-lg">{{ $otherParticipant->name }}</h3>
            </a>
        @endif
    </div>

    {{-- Message History --}}
    {{-- FIX #2: Added 'flex' and 'flex-col-reverse' to anchor messages to the bottom --}}
    <div class="flex-1 p-4 space-y-6 overflow-y-auto flex flex-col-reverse">
        {{-- The loop is now reversed, so we just need to make sure the messages are ordered correctly from the controller, which they are (latest first) --}}
        @forelse ($selectedConversation->messages as $message)
            {{-- Determine styling based on who sent the message --}}
            @if ($message->user_id === auth()->id())
                {{-- Sent Message (Right-aligned) --}}
                <div class="flex justify-end">
                    <div class="bg-blue-500 text-white rounded-lg rounded-br-none py-2 px-4 max-w-sm">
                        <p>{{ $message->body }}</p>
                        <div 
                            class="text-xs text-blue-200 mt-1 text-right"
                            x-data
                            x-text="new Date('{{ $message->created_at->toIso8601String() }}').toLocaleTimeString(undefined, {hour: 'numeric', minute: '2-digit'})"
                            title="{{ $message->created_at }}"
                        ></div>
                    </div>
                </div>
            @else
                {{-- Received Message (Left-aligned) --}}
                <div class="flex justify-start">
                    <div class="bg-gray-200 text-gray-800 rounded-lg rounded-bl-none py-2 px-4 max-w-sm">
                        <p>{{ $message->body }}</p>
                        <div 
                            class="text-xs text-gray-500 mt-1"
                            x-data
                            x-text="new Date('{{ $message->created_at->toIso8601String() }}').toLocaleTimeString(undefined, {hour: 'numeric', minute: '2-digit'})"
                            title="{{ $message->created_at }}"
                        ></div>
                    </div>
                </div>
            @endif
        @empty
            <div class="flex-1 flex flex-col items-center justify-center text-center text-gray-500">
                <p>No messages yet. Start the conversation!</p>
            </div>
        @endforelse
    </div>

    {{-- Send Message Form --}}
    <div class="p-4 border-t bg-gray-50">
        <form action="{{ route('messages.store', $selectedConversation) }}" method="POST">
            @csrf
            <div class="flex items-center space-x-3">
                <input type="text" name="body" class="flex-1 block w-full rounded-full border-gray-300 shadow-sm px-4" placeholder="Type your message..." autocomplete="off" autofocus>
                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition self-end">
                    <i class="fas fa-paper-plane mr-2"></i>
                    <span>Send</span>
                </button>
            </div>
        </form>
    </div>
@endsection