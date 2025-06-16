<x-app-layout>
    <x-slot name="title">
        {{ __('SkillConnect - Discover') }}
    </x-slot>
    
    <x-slot name="styles">
        <link rel="stylesheet" href="{{ asset('css/discovery_styles.css') }}">
    </x-slot>

    {{-- Hero Section --}}
    <div class="gradient-bg text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-4">Find Your Perfect Volunteer Opportunity</h1>
                <p class="text-xl mb-8 max-w-3xl mx-auto">Connect with meaningful causes that match your skills, interests, and schedule</p>
                <div class="max-w-3xl mx-auto">
                    {{-- This form now correctly submits to the discover route --}}
                    <form action="{{ route('discover') }}" method="GET">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input 
                                type="text" 
                                name="search" {{-- The 'name' attribute is crucial for the filter --}}
                                value="{{ request('search') }}" {{-- This keeps your search term in the box after searching --}}
                                class="block w-full pl-12 pr-32 py-4 border border-transparent rounded-full text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                placeholder="Search for opportunities, organizations, or causes..."
                            >
                            <div class="absolute inset-y-0 right-0 flex items-center pr-2">
                                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col lg:flex-row gap-6">
            {{-- Filter Sidebar --}}
            <div class="w-full lg:w-1/4">
                {{-- The form will submit using the GET method, which adds filters to the URL --}}
                <form action="{{ route('discover') }}" method="GET" class="bg-white rounded-lg shadow p-6 sticky top-24">
                    <h2 class="text-xl font-semibold mb-6">Filter Opportunities</h2>
                    

                    <div class="mb-6">
                        <label for="sort" class="font-medium text-gray-900">Sort by</label>
                        <select name="sort" id="sort" onchange="this.form.submit()" class="w-full mt-1 border-gray-300 rounded-md shadow-sm text-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="newest" @selected(request('sort', 'newest') == 'newest')>Newest</option>
                            <option value="oldest" @selected(request('sort') == 'oldest')>Oldest</option>
                            <option value="urgent" @selected(request('sort') == 'urgent')>Most Urgent</option>
                        </select>
                    </div>


                    {{-- Categories --}}
                    <div class="mb-6">
                        <h3 class="font-medium text-gray-900 mb-3">Categories</h3>
                        <div class="space-y-2">
                            @php $categories = ['Environmental', 'Education', 'Community', 'Animals', 'Programming']; @endphp
                            @foreach ($categories as $category)
                            <div class="flex items-center">
                                {{-- The name="categories[]" sends an array of checked values --}}
                                <input name="categories[]" value="{{ $category }}" type="checkbox" class="h-4 w-4 text-blue-600 rounded"
                                    {{-- This checks if the current category was in the old input --}}
                                    @if(is_array(request('categories')) && in_array($category, request('categories'))) checked @endif
                                >
                                <label class="ml-3 text-sm text-gray-700">{{ $category }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Skills --}}
                    <div class="mb-6">
                        <h3 class="font-medium text-gray-900 mb-3">Skills</h3>
                        <input type="text" name="skills" value="{{ request('skills') }}" class="w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md text-sm" placeholder="Search skills...">
                    </div>

                    {{-- Location Type --}}
                    <div class="mb-6">
                        <h3 class="font-medium text-gray-900 mb-3">Location Type</h3>
                        <select name="location_type" class="w-full border-gray-300 rounded-md text-sm">
                            <option value="">Any</option>
                            <option value="in-person" @if(request('location_type') == 'in-person') selected @endif>In-person</option>
                            <option value="virtual" @if(request('location_type') == 'virtual') selected @endif>Virtual</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
                        Apply Filters
                    </button>
                    <a href="{{ route('discover') }}" class="block w-full mt-2 text-center text-blue-600 py-2 px-4 rounded-md hover:text-blue-700">
                        Reset All
                    </a>
                </form>
            </div>

                        {{-- Opportunity Cards --}}
            {{-- This is the middle column in discovery.blade.php --}}
            <div class="w-full lg:w-2/4 space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold">Showing {{ $projects->count() }} of {{ $projects->total() }} Opportunities Found</h2>

                </div>
                
                <div class="space-y-4">
                    @forelse ($projects as $project)
                        <div class="bg-white rounded-lg shadow overflow-hidden opportunity-card">
                            <div class="p-5">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <img class="h-12 w-12 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($project->user->name) }}&color=7F9CF5&background=EBF4FF" alt="{{ $project->user->name }}'s avatar">
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <div class="flex items-center">
                                            <h3 class="text-lg font-semibold text-gray-900 hover:text-blue-600 cursor-pointer">{{ $project->title }}</h3>

                                                @if ($project->status)
                                                    @php
                                                        // Set default classes
                                                        $tagClasses = 'bg-gray-100 text-gray-800';

                                                        // Set classes based on status
                                                        if ($project->status === 'Urgent') {
                                                            $tagClasses = 'bg-red-100 text-red-800';
                                                        } elseif ($project->status === 'Environmental') {
                                                            $tagClasses = 'bg-green-100 text-green-800';
                                                        } elseif ($project->status === 'Education') {
                                                            $tagClasses = 'bg-blue-100 text-blue-800';
                                                        } elseif ($project->status === 'Programming') {
                                                            $tagClasses = 'bg-purple-100 text-purple-800';
                                                        } elseif ($project->status === 'Community') {
                                                            $tagClasses = 'bg-indigo-100 text-indigo-800';
                                                        }
                                                    @endphp

                                                    <span class="ml-2 px-2 py-0.5 text-xs font-medium  {{ $tagClasses }}">
                                                        {{ $project->status }}
                                                    </span>
                                                @endif


                                        </div>
                                        @if ($project->organization_name)
                                            <p class="text-sm text-gray-600">{{ $project->organization_name }}</p>
                                        @else
                                            <p class="text-sm text-gray-600">Posted by {{ $project->user->name }}</p>
                                        @endif
                                        <div class="mt-2 flex items-center text-sm text-gray-500">
                                            <i class="fas fa-map-marker-alt mr-1"></i>
                                            <span>{{ $project->location_address }}</span>
                                        </div>
                                        <div class="mt-1 flex items-center text-sm text-gray-500">
                                            <i class="fas fa-calendar-alt mr-1"></i>
                                            <span>{{ \Illuminate\Support\Str::replace(',', ' · ', $project->schedule_details) }}</span>
                                        </div>
                                        <div class="mt-3">
                                            <p class="text-sm text-gray-700">{{ \Illuminate\Support\Str::limit($project->description, 250) }}</p>
                                        </div>

                                        @if ($project->skills_required)
                                            <div class="mt-3">
                                                <p class="text-sm font-medium text-gray-700 mb-2">Skills Needed:</p>
                                                <div class="flex flex-wrap">
                                                    
                                                    @foreach(explode(',', $project->skills_required) as $skill)
                                                        {{-- This span has the new classes to match your exact CSS --}}
                                                        <span class="inline-flex items-center bg-sky-100 text-sky-700 text-xs font-medium py-1 px-3 rounded-full mr-2 mb-2">
                                                            <i class="fas fa-tag mr-1.5"></i>
                                                            {{ trim($skill) }}
                                                        </span>
                                                    @endforeach

                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-5 py-3 flex items-center justify-between border-t">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-users mr-1"></i>
                                    <span>{{ $project->volunteers_needed }} volunteers needed</span>
                                </div>
                                <div class="flex space-x-2">
                                    @php
                                        $isSaved = in_array($project->id, $savedProjectIds);
                                    @endphp

                                    <button
                                        class="save-btn inline-flex items-center px-3 py-1 border rounded-md text-sm font-medium transition {{
                                            $isSaved
                                            ? 'bg-sky-100 text-sky-700 border-sky-200'
                                            : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'
                                        }}"
                                        data-project-id="{{ $project->id }}"
                                    >
                                        {{-- The icon will now also be dynamic --}}
                                        <i class="fa-bookmark mr-1 {{ $isSaved ? 'fas' : 'far' }}"></i>
                                        <span class="btn-text">{{ $isSaved ? 'Saved' : 'Save' }}</span>
                                    </button>
                                    @php
                                        $hasApplied = $project->applications->contains('user_id', auth()->id());
                                    @endphp

                                    @if($hasApplied)
                                        <button class="px-4 py-1 bg-gray-400 text-white rounded-md text-sm font-medium cursor-not-allowed" disabled>
                                            <i class="fas fa-check mr-1"></i> Applied
                                        </button>
                                    @else
                                    <form action="{{ route('projects.apply', $project) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-full text-sm font-medium hover:bg-blue-600 transition">
                                            <i class="fas fa-hand-holding-heart mr-1"></i> Volunteer
                                        </button>
                                    </form>
                                    @endif

                                    <a href="{{ route('messages.start', ['user' => $project->user->id]) }}" class="px-4 py-1 bg-green-600 text-white rounded-md text-sm font-medium hover:bg-green-700">
                                        <i class="fas fa-comments mr-1"></i> Chat
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white rounded-lg shadow p-8 text-center">
                            <h3 class="text-lg font-semibold text-gray-800">No Opportunities Found</h3>
                            <p class="text-gray-600 mt-2">There are currently no projects matching your criteria. Why not be the first to post one?</p>
                            <a href="{{ route('projects.create') }}" class="mt-4 inline-block px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">
                                Post an Opportunity
                            </a>
                        </div>
                    @endforelse
                </div>

                <div class="mt-8">
                    {{ $projects->links() }}
                </div>
            </div>

            {{-- Right Sidebar --}}
            <div class="hidden lg:block lg:w-1/4">
                {{-- Recommended For You Card --}}
                <div class="sticky top-24 space-y-6">
                <div class="bg-white rounded-lg shadow p-4">
                    <h3 class="text-xl font-semibold mb-3">Recommended For You</h3>

                    <div>
                        @forelse ($recommendedProjects as $recProject)
                            @php
                                $icon = 'fa-calendar-day';
                                $bgColor = 'bg-gray-100';
                                $iconColor = 'text-gray-500';

                                switch ($recProject->status) {
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

                            <div class="flex items-start py-4 @if(!$loop->last) border-b border-gray-200 @endif">
                                {{-- MODIFIED: Replaced placeholder with dynamic status badge --}}
                                <div class="flex-shrink-0 h-12 w-12 rounded-lg {{ $bgColor }} flex items-center justify-center">
                                    <i class="fas {{ $icon }} {{ $iconColor }} text-xl"></i>
                                </div>

                                <div class="ml-3">
                                    <a href="#" class="text-m font-medium text-gray-900 hover:underline">{{ $recProject->title }}</a>
                                    
                                    @if ($recProject->matched_skill)
                                        <p class="text-xs text-gray-500">Matches your <span class="font-medium">{{ $recProject->matched_skill }}</span> skill</p>
                                    @else
                                        <p class="text-xs text-gray-500">Recommended for you</p>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">Add skills to your profile to get personalized recommendations!</p>
                        @endforelse
                    </div>
                </div>

            {{-- Saved Projects Card --}}
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="font-xl font-semibold text-gray-900 mb-3">Saved Projects</h3>
                <div>
                    @forelse ($savedProjectsForSidebar as $savedProject)
                        {{-- NEW: Logic to determine icon style based on project status --}}
                        @php
                            $icon = 'fa-calendar-day';
                            $bgColor = 'bg-gray-100';
                            $iconColor = 'text-gray-500';

                            switch ($savedProject->status) {
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

                        {{-- MODIFIED: Added flex layout and icon --}}
                        <div class="flex items-start py-4 @if(!$loop->last) border-b border-gray-200 @endif">
                            {{-- The badge icon div --}}
                            <div class="flex-shrink-0 h-12 w-12 rounded-lg {{ $bgColor }} flex items-center justify-center">
                                <i class="fas {{ $icon }} {{ $iconColor }} text-xl"></i>
                            </div>
                            {{-- The project details div --}}
                            <div class="ml-4">
                                <a href="#" class="text-sm font-semibold text-blue-600 hover:underline">{{ $savedProject->title }}</a>
                                <p class="text-xs text-gray-600 mt-1">
                                    Posted by
                                    <a href="{{ route('profile.show', $savedProject->user) }}" class="font-medium text-gray-800 hover:underline">
                                        {{ $savedProject->organization_name ?? $savedProject->user->name }}
                                    </a>
                                </p>
                                <p class="text-xs text-gray-500">Saved {{ $savedProject->pivot->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">You haven't saved any projects yet.</p>
                    @endforelse
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>

    {{-- This slot is for any page-specific JavaScript files you might have --}}
 



    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        document.querySelectorAll('.save-btn').forEach(button => {
            button.addEventListener('click', async function () {
                const projectId = this.dataset.projectId;
                const icon = this.querySelector('i');
                const textSpan = this.querySelector('.btn-text');

                const response = await fetch(`/projects/${projectId}/save`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });
                const data = await response.json();

                // Update button text and style
                textSpan.textContent = data.is_saved ? 'Saved' : 'Save';
                this.classList.toggle('bg-sky-100', data.is_saved);
                this.classList.toggle('text-sky-700', data.is_saved);
                this.classList.toggle('border-sky-200', data.is_saved);
                this.classList.toggle('bg-white', !data.is_saved);
                this.classList.toggle('text-gray-700', !data.is_saved);
                this.classList.toggle('border-gray-300', !data.is_saved);

                // Update icon style (solid vs regular)
                icon.classList.toggle('fas', data.is_saved); // solid icon
                icon.classList.toggle('far', !data.is_saved); // regular icon
            });
        });
    });
    </script>
    @endpush
</x-app-layout>