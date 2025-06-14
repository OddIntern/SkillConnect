{{-- resources/views/messages/index.blade.php --}}
@extends('layouts.messaging')

{{-- This section will be injected into the 'conversation-list' yield in our layout --}}
@section('conversation-list')
    @include('messages._conversation-list', ['conversations' => $conversations])
@endsection

{{-- This section will be injected into the 'conversation-content' yield --}}
@section('conversation-content')
    <div class="flex flex-col items-center justify-center h-full text-center text-gray-500 p-4">
        <i class="fas fa-comments text-6xl text-gray-300 mb-4"></i>
        <h3 class="text-xl font-semibold">Select a conversation</h3>
        <p class="max-w-xs">Choose a conversation from the list on the left to start chatting.</p>
    </div>
@endsection