<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse; // <-- THIS IS THE MAIN FIX
use Illuminate\View\View;

class ConversationController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $conversations = $user->conversations()
            ->with([
                'participants' => function($query) use ($user) {
                    $query->where('users.id', '!=', $user->id);
                },
                'latestMessage.user'
            ])
            ->get();

        return view('messages.index', [
            'conversations' => $conversations
        ]);
    }

    public function start(Request $request, User $user): RedirectResponse
    {
        $currentUser = $request->user();

        if ($currentUser->id === $user->id) {
            return back()->with('error', 'You cannot start a conversation with yourself.');
        }

        $conversation = $currentUser->findConversationWith($user);

        if (!$conversation) {
            $conversation = Conversation::create();
            $conversation->participants()->attach([$currentUser->id, $user->id]);
        }

        return redirect()->route('messages.show', $conversation);
    }

    public function show(Conversation $conversation): View
    {
        // Authorize that the current user can view this conversation
        $this->authorize('view', $conversation);

        // --- Start of new logic ---

        // Get all conversations for the left pane, just like in the index method
        $user = auth()->user();
        $conversations = $user->conversations()
            ->with([
                'participants' => function($query) use ($user) {
                    $query->where('users.id', '!=', $user->id);
                },
                'latestMessage.user'
            ])
            ->get();

        // Eager load the messages and their senders for the selected conversation (right pane)
        $conversation->load('messages.user');

        // --- End of new logic ---

        return view('messages.show', [
            'conversations' => $conversations,
            'selectedConversation' => $conversation, // Pass the selected conversation to the view
        ]);
    }

    public function storeMessage(Request $request, Conversation $conversation): RedirectResponse
    {
        $this->authorize('view', $conversation);

        $validated = $request->validate([
            'body' => 'required|string',
        ]);

        $conversation->messages()->create([
            'user_id' => auth()->id(),
            'body' => $validated['body'],
        ]);

        return back();
    }
}