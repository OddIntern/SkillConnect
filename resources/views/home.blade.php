<x-app-layout>

    <x-slot name="title">
     {{ __('SkillConnect - Home') }}
    </x-slot>
    {{-- Hero Section --}}
    <div class="gradient-bg text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-8 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">Make a Difference Together</h1>
                    <p class="text-xl mb-6">Connect with local volunteer opportunities and create meaningful change in your community.</p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('discover') }}" class="bg-white text-blue-600 hover:bg-gray-100 px-6 py-3 rounded-full font-medium transition duration-300">
                            Find Opportunities
                        </a>
                        <button @click.prevent="openCreatePostModal()" class="bg-blue-700 hover:bg-blue-800 text-white px-6 py-3 rounded-full font-medium transition duration-300">
                            Post a Need
                        </button>
                    </div>
                </div>
                <div class="md:w-1/2 relative">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&h=600&q=80" alt="Volunteers working together" class="rounded-lg shadow-xl w-full max-w-md mx-auto">
                    <div class="absolute -bottom-4 -left-4 bg-white p-4 rounded-lg shadow-lg hidden md:block">
                        <div class="flex items-center">
                            <div class="bg-blue-100 p-3 rounded-full mr-3">
                                <i class="fas fa-hands-helping text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">1,245+</p>
                                <p class="text-sm text-gray-600">Active Volunteers</p>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -top-4 -right-4 bg-white p-4 rounded-lg shadow-lg hidden md:block">
                        <div class="flex items-center">
                            <div class="bg-green-100 p-3 rounded-full mr-3">
                                <i class="fas fa-heart text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">568+</p>
                                <p class="text-sm text-gray-600">Projects Completed</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col md:flex-row gap-6">
            <div class="w-full md:w-1/3 lg:w-1/4 space-y-6">
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    {{-- The entire top section is now a single link to the user's profile --}}
                    <a href="{{ route('profile.show', auth()->user()) }}" class="block hover:opacity-90 transition">
                        <div class="gradient-bg h-20"></div>
                        <div class="px-4 pb-6 relative">
                            <div class="flex justify-center">
                                <div class="rounded-full -mt-12 border-4 border-white overflow-hidden">
                                    @if (auth()->user()->avatar_path)
                                        <img class="h-24 w-24 rounded-full object-cover avatar-ring" src="{{ Storage::url(auth()->user()->avatar_path) }}" alt="{{ auth()->user()->name }}'s avatar">
                                    @else
                                        <img class="h-24 w-24 rounded-full avatar-ring" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&size=256&background=EBF4FF&color=7F9CF5" alt="{{ auth()->user()->name }}'s avatar">
                                    @endif
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <h2 class="text-lg font-semibold text-gray-900">{{ auth()->user()->name }}</h2>
                                <p class="text-sm text-gray-600">{{ auth()->user()->headline ?? ' ' }}</p>
                                
                            </div>
                            <div class="mt-6 pt-4 border-t border-gray-200">
                                <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3 text-center">Top Skills</h4>
                                <div class="flex flex-wrap justify-center gap-2">
                                    {{-- Loop through the first 5 skills --}}
                                    @forelse ($user->skills->take(5) as $skill)
                                        <span class="bg-sky-100 text-sky-800 text-xs font-medium py-1 px-3 rounded-full">
                                            {{ $skill->name }}
                                        </span>
                                    @empty
                                        <p class="text-xs text-gray-500">No skills added yet.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </a>

                </div>

                <div class="bg-white rounded-lg shadow p-4">
                <h3 class="font-medium text-gray-900 mb-3">Quick Actions</h3>
                <div class="space-y-2">
                    <button @click.prevent="openCreatePostModal()" class="w-full flex items-center justify-between px-4 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition">
                        <span><i class="fas fa-plus mr-2"></i> Create Post</span>
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    <a href="{{ route('discover') }}" class="w-full flex items-center justify-between px-4 py-2 bg-green-50 text-green-600 rounded-lg hover:bg-green-100 transition">
                        <span><i class="fas fa-search mr-2"></i> Find Projects</span>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div>
                        <!-- Upcoming Events -->
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="font-medium text-gray-900 mb-3">Your Active Projects</h3>
                <div class="space-y-3">
                    @forelse ($upcomingEvents as $event)
                         <div class="flex items-start py-4 @if(!$loop->last) border-b border-gray-200 @endif">
                            @php
                                $icon = 'fa-calendar-day';
                                $bgColor = 'bg-gray-100';
                                $iconColor = 'text-gray-500';

                                switch ($event->status) {
                                    case 'Urgent':
                                        $icon = 'fa-circle-exclamation';
                                        $bgColor = 'bg-red-100';
                                        $iconColor = 'text-red-500';
                                        break;
                                    case 'Environmental':
                                        $icon = 'fa-tree';
                                        $bgColor = 'bg-green-100';
                                        $iconColor = 'text-green-500';
                                        break;
                                    case 'Education':
                                        $icon = 'fa-graduation-cap';
                                        $bgColor = 'bg-blue-100';
                                        $iconColor = 'text-blue-500';
                                        break;
                                    case 'Community':
                                        $icon = 'fa-users';
                                        $bgColor = 'bg-yellow-100';
                                        $iconColor = 'text-yellow-500';
                                        break;
                                    case 'Animals':
                                        $icon = 'fa-paw';
                                        $bgColor = 'bg-orange-100';
                                        $iconColor = 'text-orange-500';
                                        break;
                                    case 'Health':
                                        $icon = 'fa-heart-pulse';
                                        $bgColor = 'bg-rose-100';
                                        $iconColor = 'text-rose-500';
                                        break;
                                    case 'Programming':
                                        $icon = 'fa-code';
                                        $bgColor = 'bg-indigo-100';
                                        $iconColor = 'text-indigo-500';
                                        break;
                                }
                            @endphp

                            <div class="flex-shrink-0 {{ $bgColor }} rounded-lg p-2 w-8 h-8 flex items-center justify-center">
                                <i class="fas {{ $icon }} {{ $iconColor }}"></i>
                            </div>

                            <div class="ml-3">
                                <p class="text-sm font-medium {{ $event->status === 'Urgent' ? 'text-red-600' : 'text-gray-900' }}">
                                    {{ $event->title }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    {{ $event->schedule_details }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-3">
                            <p class="text-sm text-gray-500">You have no upcoming events.</p>
                            <a href="{{ route('discover') }}" class="text-xs text-blue-600 hover:underline font-medium">Find a project to join!</a>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>


            

            <div class="w-full md:w-2/3 lg:w-1/2 space-y-6">
                <div class="space-y-4">

                @forelse ($projects as $project)
                <div @click.prevent="openProjectModal({{ $project->id }})" class="bg-white rounded-lg shadow overflow-hidden post-card hover:shadow-lg transition cursor-pointer">
                    <div class="p-4">
                        {{-- Card Header --}}
                        <div class="flex items-start">
                                <a href="{{ route('profile.show', $project->user) }}" @click.stop>
                                    @if ($project->user->avatar_path)
                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Storage::url($project->user->avatar_path) }}" alt="{{ $project->user->name }}'s avatar">
                                    @else
                                        <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($project->user->name) }}&color=7F9CF5&background=EBF4FF" alt="{{ $project->user->name }}'s avatar">
                                    @endif
                                </a>
                            <div class="ml-3">
                                <a href="{{ route('profile.show', $project->user) }}" class="text-sm font-medium text-gray-900 hover:underline" @click.stop>{{ $project->user->name }}</a>
                                
                                {{-- Show the timestamp and status on the second line --}}
                                <p class="text-xs text-gray-500">
                                    <span>{{ $project->created_at->diffForHumans() }}</span>
                                    
                                    @if($project->status)
                                        @php
                                            $statusColor = 'text-gray-600'; 
                                            if ($project->status === 'Urgent') { $statusColor = 'text-red-600'; }
                                            elseif ($project->status === 'Environmental') { $statusColor = 'text-green-600'; }
                                            elseif ($project->status === 'Education') { $statusColor = 'text-blue-600'; }
                                            elseif ($project->status === 'Programming') { $statusColor = 'text-purple-600'; }
                                            elseif ($project->status === 'Community') { $statusColor = 'text-indigo-600'; }
                                            elseif ($project->status === 'Health') { $statusColor = 'text-rose-600'; }
                                            elseif ($project->status === 'Animals') { $statusColor = 'text-orange-600'; }
                                        @endphp
                                        <span class="font-medium {{ $statusColor }}"> · {{ $project->status }}</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        {{-- Card Body --}}
                        <div class="mt-4">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $project->title }}</h3>
                            <p class="mt-1 text-sm text-gray-700">{{ $project->description }}</p>

                            {{-- Skills Section --}}
                            @if ($project->skills_required)
                                <div class="mt-3">
                                    <p class="text-sm font-medium text-gray-700 mb-2">Skills Required:</p>
                                    <div class="flex flex-wrap">
                                        @foreach(explode(',', $project->skills_required) as $skill)
                                            <span class="inline-flex items-center bg-sky-100 text-sky-700 text-xs font-medium py-1 px-3 rounded-full mr-2 mb-2">
                                                <i class="fas fa-tag mr-1.5"></i>
                                                {{ trim($skill) }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            {{-- Meta Info Block with Icons --}}
                            <div class="mt-4 space-y-2">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-map-marker-alt mr-2 w-4 text-center"></i>
                                    <span>{{ $project->location_address }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-calendar-alt mr-2 w-4 text-center"></i>
                                    <span>{{ \Illuminate\Support\Str::replace(',', ' · ', $project->schedule_details) }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-users mr-2 w-4 text-center"></i>
                                    <span>{{ $project->volunteers_needed }} volunteers needed</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Card Footer --}}
                <div class="bg-gray-50 px-4 py-3 flex items-center justify-between border-t">
                    <div @click.stop class="flex space-x-4">
                        @php
                            $hasLiked = in_array($project->id, $likedProjectIds);
                        @endphp
                        {{-- Dynamic Like Button --}}
                        <button class="like-btn flex items-center transition {{ $hasLiked ? 'text-red-500' : 'text-gray-500 hover:text-red-500' }}" data-project-id="{{ $project->id }}">
                            <i class="{{ $hasLiked ? 'fas' : 'far' }} fa-heart mr-1"></i>
                            <span class="like-count">{{ $project->likers_count }}</span>
                        </button>

                        {{-- Dynamic Comment Count (already correct) --}}
                        <a href="#" @click.prevent="openProjectModal({{ $project->id }})" class="flex items-center text-gray-500 hover:text-green-500">
                            <i class="far fa-comment mr-1"></i>
                            <span>{{ $project->comments_count }}</span>
                        </a>
                    </div>

                    @php
                        $hasApplied = $project->applications->contains('user_id', auth()->id());
                    @endphp

                    @if($hasApplied)
                        <button @click.stop class="px-4 py-1 bg-gray-400 text-white rounded-md text-sm font-medium cursor-not-allowed" disabled>
                            <i class="fas fa-check mr-1"></i> Applied
                        </button>
                    @else
                        <form @click.stop action="{{ route('projects.apply', $project) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-full text-sm font-medium hover:bg-blue-600 transition">
                                <i class="fas fa-hand-holding-heart mr-1"></i> Volunteer
                            </button>
                        </form>
                    @endif
                </div>
                </div>

                @empty
                    <div class="bg-white rounded-lg shadow p-8 text-center">
                    <h3 class="text-lg font-semibold text-gray-800">The Feed is Quiet...</h3>
                    <p class="text-gray-600 mt-2">There are no projects to show right now. Be the first to create one!</p>
                </div>
                @endforelse

                    <div class="mt-6" >
                        {{ $projects->links() }}
                    </div>
                </div>
            </div>

            <div class="hidden lg:block lg:w-1/4 space-y-6">

            <!-- Recommended Volunteers -->
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="font-medium text-gray-900 mb-3">Recommended Volunteers</h3>
                <div class="space-y-3">

                    @forelse ($recommendedUsers as $recommendedUser)
                        <div class="flex items-center">
                            <a href="{{ route('profile.show', $recommendedUser) }}">
                                @if ($recommendedUser->avatar_path)
                                   <img class="h-10 w-10 rounded-full object-cover" src="{{ Storage::url($recommendedUser->avatar_path) }}" alt="{{ $recommendedUser->name }}'s avatar">
                                @else
                                      <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($recommendedUser->name) }}&size=256&background=EBF4FF&color=7F9CF5" alt="{{ $recommendedUser->name }}'s avatar">
                                 @endif
                            </a>
                            <div class="ml-3">
                                <a href="{{ route('profile.show', $recommendedUser) }}" class="text-sm font-medium text-gray-900 hover:underline">{{ $recommendedUser->name }}</a>
                                <p class="text-xs text-gray-500">{{ $recommendedUser->headline ?? 'New Member' }}</p>
                            </div>
                            {{-- We can wire this button up later using the same toggle logic --}}
                            <form action="{{ route('users.follow', $recommendedUser) }}" method="POST" class="ml-auto">
                                @csrf
                                <button type="submit" class="text-blue-500 hover:text-blue-700 text-xs font-bold">
                                    Follow
                                </button>
                            </form>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">No new recommendations at this time.</p>
                    @endforelse

                </div>
            </div>


            {{-- "Incoming Applicants" Section --}}
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Incoming Applicants</h3>
                <div class="space-y-6">
                    {{-- This outer loop for each project remains the same --}}
                    @forelse ($incomingApplicants as $projectTitle => $applications)
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                            <h4 class="font-bold text-gray-900 mb-3">{{ $projectTitle }}</h4>

                            <div class="space-y-4">
                                {{-- Loop through the applicants for THIS project --}}
                                @foreach ($applications as $application)
                                    <div class="py-3 border-b border-gray-200 last:border-b-0">
                                        {{-- Row 1: Name and Time --}}
                                        <div class="flex items-baseline justify-between">
                                            <a href="{{ route('profile.show', $application->user) }}" class="font-semibold text-blue-700 hover:underline">
                                                {{ $application->user->name }}
                                            </a>
                                            <p class="text-xs text-gray-500">
                                            {{ $application->created_at->diffForHumans() }}
                                            </p>
                                        </div>


                                        <div class="mt-2">
                                            <form action="{{ route('applications.update', $application->id) }}" method="POST" class="flex gap-2">
                                                @csrf
                                                @method('PATCH')
                                                <button name="status" value="accepted" class="font-semibold text-xs px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition">Accept</button>
                                                <button name="status" value="declined" class="font-semibold text-xs px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition">Decline</button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <p class="text-sm text-gray-500">When someone applies to your projects, you'll see them here.</p>
                        </div>
                    @endforelse
                </div>
            </div>


            <div class="bg-white rounded-lg shadow p-4">
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Accepted Projects</h3>
                    <div class="space-y-4">
                        @forelse ($acceptedProjects as $project)
                            <div class="bg-green-50 border border-green-200 rounded-lg shadow-sm p-4">
                                <h4 class="font-bold text-green-800">{{ $project->title }}</h4>
                                <p class="text-xs text-gray-600 mt-1">
                                    Posted by
                                    
                                    <a href="{{ route('profile.show', $project->user) }}" class="font-medium text-gray-900 hover:underline">
                                        
                                        {{ $project->organization_name ?? $project->user->name }}
                                    </a>
                                </p>
                                <p class="text-sm text-gray-700 mt-1">{{ Str::limit($project->description, 100) }}</p>
                                <p class="text-xs text-gray-500 mt-2">You were accepted {{ $project->pivot->updated_at->diffForHumans() }}</p>
                            </div>
                        @empty
                            {{-- This block will be displayed if the $acceptedProjects collection is empty --}}
                            <div class="text-center py-4">
                                <p class="text-sm text-gray-500">You haven't been accepted to any projects yet.</p>
                                <a href="{{ route('discover') }}" class="mt-2 inline-block text-sm text-blue-600 hover:underline font-semibold">
                                    Find opportunities to apply for!
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4">
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Pending Projects</h3>
                    <div class="space-y-4">
                        @forelse ($pendingProjects as $project)
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg shadow-sm p-4">
                                <h4 class="font-bold text-yellow-800">{{ $project->title }}</h4>
                                <p class="text-xs text-gray-600 mt-1">
                                    Posted by
                                    <a href="{{ route('profile.show', $project->user) }}" class="font-medium text-gray-900 hover:underline">
                                        {{ $project->organization_name ?? $project->user->name }}
                                    </a>
                                </p>
                                <p class="text-sm text-gray-700 mt-1">{{ Str::limit($project->description, 300) }}</p>
                                <p class="text-xs text-gray-500 mt-2">You applied {{ $project->pivot->updated_at->diffForHumans() }}</p>
                            </div>
                        @empty
                            {{-- This block will be displayed if the $acceptedProjects collection is empty --}}
                            <div class="text-center py-4">
                                <p class="text-sm text-gray-500">Your pending project applications will show up here!</p>
                                <a href="{{ route('discover') }}" class="mt-2 inline-block text-sm text-blue-600 hover:underline font-semibold">
                                    Find opportunities to apply for!
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            </div>
        </div>
    </div>

    @push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.querySelectorAll('.like-btn').forEach(button => {
        button.addEventListener('click', async function (event) {
            if (!{{ auth()->check() ? 'true' : 'false' }}) {
                window.location.href = '{{ route('login') }}';
                return;
            }

            const projectId = this.dataset.projectId;
            const icon = this.querySelector('i');
            const countSpan = this.querySelector('.like-count');

            const response = await fetch(`/projects/${projectId}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            });
            const data = await response.json();

            if (data.success) {
                countSpan.textContent = data.likes_count;
                this.classList.toggle('text-red-500');
                this.classList.toggle('text-gray-500');
                icon.classList.toggle('fas'); 
                icon.classList.toggle('far'); 
            }
        });
    });
});
</script>
@endpush

</x-app-layout>