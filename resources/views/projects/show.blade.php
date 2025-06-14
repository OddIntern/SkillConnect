{{-- resources/views/projects/show.blade.php --}}
<div class="p-6 md:p-8">
    {{-- Modal Header --}}
    <div class="flex justify-between items-start border-b pb-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">{{ $project->title }}</h2>
            <p class="text-sm text-gray-500">
                Posted by 
                <a href="{{ route('profile.show', $project->user) }}" class="font-medium hover:underline">{{ $project->user->name }}</a>
            </p>
        </div>
        <button @click="openModal = null" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
    </div>

    {{-- Main Project Description --}}
    <div class="prose prose-sm max-w-none mb-6">
        <p>{{ $project->description }}</p>
    </div>

    {{-- START: New Details Section --}}
    <div class="space-y-6 border-t border-b py-6 mb-6">
        @if ($project->skills_required)
            <div>
                <h4 class="font-semibold text-gray-800 mb-2">Skills Needed</h4>
                <div class="flex flex-wrap gap-2">
                    @foreach(explode(',', $project->skills_required) as $skill)
                        <span class="inline-flex items-center bg-sky-100 text-sky-800 text-xs font-medium py-1 px-3 rounded-full">
                            <i class="fas fa-tag mr-1.5"></i>
                            {{ trim($skill) }}
                        </span>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-600">
            <div class="flex items-center">
                <i class="fas fa-calendar-alt mr-3 w-4 text-center text-gray-400"></i>
                <span>{{ $project->schedule_details }}</span>
            </div>
            <div class="flex items-center">
                <i class="fas fa-map-marker-alt mr-3 w-4 text-center text-gray-400"></i>
                <span>{{ $project->location_address }}</span>
            </div>
            <div class="flex items-center">
                <i class="fas fa-users mr-3 w-4 text-center text-gray-400"></i>
                <span>{{ $project->volunteers_needed }} volunteers needed</span>
            </div>
        </div>
    </div>

    {{-- Comments --}}
    <div>
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Comments ({{ $project->comments->count() }})</h3>
        
        {{-- Form to add a new comment --}}
        <form action="{{ route('comments.store', $project) }}" method="POST" class="mb-6">
            @csrf
            <div class="flex items-start space-x-3">
                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}" alt="Your avatar">
                <div class="flex-1">
                    <textarea name="body" rows="2" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="Add a public comment..."></textarea>
                    <div class="text-right mt-2">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">Post Comment</button>
                    </div>
                </div>
            </div>
        </form>

        {{-- List of existing comments --}}
        <div class="space-y-6">
            @forelse ($project->comments as $comment)
                <div class="flex items-start space-x-3">
                    <a href="{{ route('profile.show', $comment->user) }}">
                        <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}" alt="Commenter's avatar">
                    </a>
                    <div class="flex-1 bg-gray-100 rounded-lg p-3">
                        <div class="flex items-center">
                            <a href="{{ route('profile.show', $comment->user) }}" class="font-semibold text-sm mr-2 hover:underline">{{ $comment->user->name }}</a>
                            <p class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                        </div>
                        <p class="text-sm text-gray-700 mt-1">{{ $comment->body }}</p>
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500">No comments yet. Be the first to say something!</p>
            @endforelse
        </div>
    </div>
</div>