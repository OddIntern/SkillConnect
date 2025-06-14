{{-- resources/views/profile/_user-list-item.blade.php --}}
<div class="flex items-center justify-between">
    <div class="flex items-center space-x-3">
        <a href="{{ route('profile.show', $userToList) }}">
            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($userToList->name) }}" alt="Avatar">
        </a>
        <div>
            <a href="{{ route('profile.show', $userToList) }}" class="font-semibold text-sm hover:underline">{{ $userToList->name }}</a>
            <p class="text-sm text-gray-500">{{ $userToList->headline }}</p>
        </div>
    </div>

    @if(auth()->id() !== $userToList->id)
        <form action="{{ route('users.follow', $userToList) }}" method="POST">
            @csrf
            @php
                $isFollowing = auth()->user()->following->contains($userToList);
            @endphp
            <button type="submit" class="text-sm font-bold py-1 px-4 rounded-lg transition {{ $isFollowing ? 'bg-gray-200 text-gray-800 hover:bg-gray-300' : 'bg-blue-500 text-white hover:bg-blue-600' }}">
                {{ $isFollowing ? 'Following' : 'Follow' }}
            </button>
        </form>
    @endif
</div>