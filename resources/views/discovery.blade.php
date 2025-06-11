<x-app-layout>
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
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" class="block w-full pl-10 pr-12 py-4 border border-transparent rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Search for opportunities, organizations, or causes...">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <button class="px-4 py-2 bg-blue-600 text-white rounded-r-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Search
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col lg:flex-row gap-6">
            {{-- Filter Sidebar --}}
            <div class="w-full lg:w-1/4">
                <div class="bg-white rounded-lg shadow p-6 sticky top-24">
                    <h2 class="text-xl font-semibold mb-6">Filter Opportunities</h2>
                        <!-- Categories -->
                        <div class="mb-6">
                            <h3 class="font-medium text-gray-900 mb-3">Categories</h3>
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <input id="environmental" name="category" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="environmental" class="ml-3 text-sm text-gray-700">Environmental</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="education" name="category" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="education" class="ml-3 text-sm text-gray-700">Education</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="community" name="category" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="community" class="ml-3 text-sm text-gray-700">Community</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="animals" name="category" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="animals" class="ml-3 text-sm text-gray-700">Animals</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="programming" name="category" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="programming" class="ml-3 text-sm text-gray-700">Programming</label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Distance -->
                        <div class="mb-6">
                            <h3 class="font-medium text-gray-900 mb-3">Distance</h3>
                            <div class="px-2">
                                <input type="range" min="0" max="50" value="25" class="w-full">
                            </div>
                            <div class="flex justify-between mt-1 text-xs text-gray-500">
                                <span>0 mi</span>
                                <span>25 mi</span>
                                <span>50 mi</span>
                            </div>
                        </div>
                        
                        <!-- Date & Time -->
                        <div class="mb-6">
                            <h3 class="font-medium text-gray-900 mb-3">Date & Time</h3>
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <input id="anytime" name="time" type="radio" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" checked>
                                    <label for="anytime" class="ml-3 text-sm text-gray-700">Anytime</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="weekend" name="time" type="radio" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                    <label for="weekend" class="ml-3 text-sm text-gray-700">This Weekend</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="weekday" name="time" type="radio" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                    <label for="weekday" class="ml-3 text-sm text-gray-700">Weekdays</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="evenings" name="time" type="radio" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                    <label for="evenings" class="ml-3 text-sm text-gray-700">Evenings</label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Skills -->
                        <div class="mb-6">
                            <h3 class="font-medium text-gray-900 mb-3">Skills</h3>
                            <div class="relative">
                                <input type="text" class="w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Search skills...">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                            </div>
                            <div class="mt-3 flex flex-wrap">
                                <span class="skill-tag cursor-pointer hover:bg-blue-100">Teaching</span>
                                <span class="skill-tag cursor-pointer hover:bg-blue-100">Cooking</span>
                                <span class="skill-tag cursor-pointer hover:bg-blue-100">First Aid</span>
                                <span class="skill-tag cursor-pointer hover:bg-blue-100">Construction</span>
                                <span class="skill-tag cursor-pointer hover:bg-blue-100">Graphic Design</span>
                                <span class="skill-tag cursor-pointer hover:bg-blue-100">Public Speaking</span>
                            </div>
                        </div>
                        
                        <!-- Commitment -->
                        <div class="mb-6">
                            <h3 class="font-medium text-gray-900 mb-3">Commitment Level</h3>
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <input id="one-time" name="commitment" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" checked>
                                    <label for="one-time" class="ml-3 text-sm text-gray-700">One-time</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="short-term" name="commitment" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" checked>
                                    <label for="short-term" class="ml-3 text-sm text-gray-700">Short-term</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="ongoing" name="commitment" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="ongoing" class="ml-3 text-sm text-gray-700">Ongoing</label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Virtual/In-Person -->
                        <div class="mb-6">
                            <h3 class="font-medium text-gray-900 mb-3">Opportunity Type</h3>
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <input id="in-person" name="type" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" checked>
                                    <label for="in-person" class="ml-3 text-sm text-gray-700">In-person</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="virtual" name="type" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="virtual" class="ml-3 text-sm text-gray-700">Virtual</label>
                                </div>
                            </div>
                        </div>
                        
                        <button class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Apply Filters
                        </button>
                        <button class="w-full mt-2 text-blue-600 py-2 px-4 rounded-md hover:text-blue-700 focus:outline-none">
                            Reset All
                        </button>
                </div>
            </div>

                        {{-- Opportunity Cards --}}
            {{-- This is the middle column in discovery.blade.php --}}
            <div class="w-full lg:w-2/4 space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold">Showing {{ $projects->count() }} of {{ $projects->total() }} Opportunities Found</h2>
                    <div class="flex items-center">
                        <span class="text-sm text-gray-600 mr-2">Sort by:</span>
                        <select class="border-gray-300 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500">
                            <option>Newest</option>
                            <option>Most Relevant</option>
                            <option>Closest</option>
                            <option>Most Urgent</option>
                        </select>
                    </div>
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
                                    <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                                        <i class="far fa-heart mr-1"></i> Save
                                    </button>
                                    <button class="px-4 py-1 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">
                                        <i class="fas fa-hand-holding-heart mr-1"></i> Volunteer
                                    </button>
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

            {{-- Right Sidebar with Map --}}
            <div class="hidden lg:block lg:w-1/4">
                <div class="bg-white rounded-lg shadow p-4 sticky top-24">
                        <h2 class="text-xl font-semibold mb-4">Opportunities Near You</h2>
                        <div class="map-container mb-4">
                            <!-- This would be replaced with an actual map component -->
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                <i class="fas fa-map-marked-alt text-4xl text-gray-400"></i>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                    <i class="fas fa-map-pin text-blue-500"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">Beach Cleanup</p>
                                    <p class="text-xs text-gray-500">2.3 mi away · Santa Monica</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                    <i class="fas fa-map-pin text-green-500"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">Food Bank</p>
                                    <p class="text-xs text-gray-500">5.7 mi away · Downtown LA</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                                    <i class="fas fa-map-pin text-purple-500"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">Animal Shelter</p>
                                    <p class="text-xs text-gray-500">3.1 mi away · West LA</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center">
                                    <i class="fas fa-map-pin text-yellow-500"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">Community Garden</p>
                                    <p class="text-xs text-gray-500">1.8 mi away · Culver City</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <h3 class="font-medium text-gray-900 mb-2">Recommended For You</h3>
                            <div class="bg-blue-50 p-3 rounded-lg">
                                <p class="text-sm text-blue-700">Based on your skills and interests, we think you'd be great for these opportunities:</p>
                                <ul class="mt-2 space-y-1 text-sm text-blue-700">
                                    <li class="flex items-center">
                                        <i class="fas fa-chevron-right text-xs mr-2"></i>
                                        <span>Youth Mentor Program</span>
                                    </li>
                                    <li class="flex items-center">
                                        <i class="fas fa-chevron-right text-xs mr-2"></i>
                                        <span>Website Redesign Volunteer</span>
                                    </li>
                                    <li class="flex items-center">
                                        <i class="fas fa-chevron-right text-xs mr-2"></i>
                                        <span>Park Restoration Project</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

    {{-- This slot is for any page-specific JavaScript files you might have --}}
    <x-slot name="scripts">
        {{-- <script src="{{ asset('js/discovery_page_specific.js') }}"></script> --}}
    </x-slot>
</x-app-layout>