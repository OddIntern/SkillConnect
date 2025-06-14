<x-app-layout>
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
                                    {{-- Using a dynamic placeholder avatar based on the user's name --}}
                                    <img class="h-24 w-24 rounded-full avatar-ring" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&size=256&background=EBF4FF&color=7F9CF5" alt="{{ auth()->user()->name }}'s avatar">
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <h2 class="text-lg font-semibold text-gray-900">{{ auth()->user()->name }}</h2>
                                <p class="text-sm text-gray-600">{{ auth()->user()->headline ?? ' ' }}</p>
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
                    <button class="w-full flex items-center justify-between px-4 py-2 bg-green-50 text-green-600 rounded-lg hover:bg-green-100 transition">
                        <span><i class="fas fa-search mr-2"></i> Find Projects</span>
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
                        <!-- Upcoming Events -->
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="font-medium text-gray-900 mb-3">Upcoming Events</h3>
                <div class="space-y-3">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-blue-100 rounded-lg p-2">
                            <i class="fas fa-calendar-day text-blue-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Beach Cleanup</p>
                            
                            <p class="text-xs text-gray-500">Tomorrow, 9:00 AM</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-green-100 rounded-lg p-2">
                            <i class="fas fa-utensils text-green-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Food Bank Help</p>
                            <p class="text-xs text-gray-500">Sat, 1:00 PM</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-purple-100 rounded-lg p-2">
                            <i class="fas fa-tree text-purple-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Tree Planting</p>
                            <p class="text-xs text-gray-500">Next Wed, 10:00 AM</p>
                        </div>
                    </div>
                </div>
                <button class="mt-3 w-full text-center text-blue-500 text-sm font-medium hover:text-blue-700">
                    View All Events
                </button>
            </div>

            </div>

            <div class="w-full md:w-2/3 lg:w-1/2 space-y-6">
                <div class="space-y-4">

                @forelse ($projects as $project)
                <div class="bg-white rounded-lg shadow overflow-hidden post-card">
                    <div class="p-4">
                        {{-- Card Header --}}
                        <div class="flex items-start">
                            {{-- For profile picture, update this later to allow user's own profile image if added --}}
                                <a href="{{ route('profile.show', $project->user) }}">
                                    <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($project->user->name) }}&color=7F9CF5&background=EBF4FF" alt="{{ $project->user->name }}'s avatar">
                                </a>
                            <div class="ml-3">
                                <a href="{{ route('profile.show', $project->user) }}" class="text-sm font-medium text-gray-900 hover:underline">{{ $project->user->name }}</a>
                                
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
                        <div class="flex space-x-4">
                            <button class="flex items-center text-gray-500 hover:text-blue-500">
                                <i class="far fa-heart mr-1"></i>
                                <span>24</span> {{-- Placeholder --}}
                            </button>
                            <button class="flex items-center text-gray-500 hover:text-green-500">
                                <i class="far fa-comment mr-1"></i>
                                <span>8</span> {{-- Placeholder --}}
                            </button>
                        </div>
                        <button class="px-4 py-2 bg-blue-500 text-white rounded-full text-sm font-medium hover:bg-blue-600 transition">
                            <i class="fas fa-hand-holding-heart mr-1"></i> Volunteer
                        </button>
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
            <!-- Trending Projects -->
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="font-medium text-gray-900 mb-3">Trending Projects</h3>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 h-12 w-12 rounded-lg overflow-hidden">
                            <img class="h-full w-full object-cover" src="https://images.unsplash.com/photo-1526779259212-939e64788e3c?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&h=200&q=80" alt="Project image">
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Urban Garden Initiative</p>
                            <p class="text-xs text-gray-500">45 volunteers this week</p>
                            <div class="mt-1 w-full bg-gray-200 rounded-full h-1.5">
                                <div class="bg-green-500 h-1.5 rounded-full" style="width: 85%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 h-12 w-12 rounded-lg overflow-hidden">
                            <img class="h-full w-full object-cover" src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&h=200&q=80" alt="Project image">
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Coding for Kids</p>
                            <p class="text-xs text-gray-500">32 volunteers this week</p>
                            <div class="mt-1 w-full bg-gray-200 rounded-full h-1.5">
                                <div class="bg-blue-500 h-1.5 rounded-full" style="width: 75%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 h-12 w-12 rounded-lg overflow-hidden">
                            <img class="h-full w-full object-cover" src="https://images.unsplash.com/photo-1559715541-5daf8a0298d0?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&h=200&q=80" alt="Project image">
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Homeless Shelter Support</p>
                            <p class="text-xs text-gray-500">28 volunteers this week</p>
                            <div class="mt-1 w-full bg-gray-200 rounded-full h-1.5">
                                <div class="bg-purple-500 h-1.5 rounded-full" style="width: 65%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="mt-3 w-full text-center text-blue-500 text-sm font-medium hover:text-blue-700">
                    See All Trending
                </button>
            </div>

            <!-- Recommended Volunteers -->
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="font-medium text-gray-900 mb-3">Recommended Volunteers</h3>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&h=200&q=80" alt="User avatar">
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Emma Rodriguez</p>
                            <p class="text-xs text-gray-500">Specializes in Education</p>
                        </div>
                        <button class="ml-auto text-blue-500 hover:text-blue-700">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <div class="flex items-center">
                        <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&h=200&q=80" alt="User avatar">
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">James Smith</p>
                            <p class="text-xs text-gray-500">Environmental Expert</p>
                        </div>
                        <button class="ml-auto text-blue-500 hover:text-blue-700">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <div class="flex items-center">
                        <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&h=200&q=80" alt="User avatar">
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Sophia Lee</p>
                            <p class="text-xs text-gray-500">Community Organizer</p>
                        </div>
                        <button class="ml-auto text-blue-500 hover:text-blue-700">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <button class="mt-3 w-full text-center text-blue-500 text-sm font-medium hover:text-blue-700">
                    View All Recommendations
                </button>
            </div>

            <!-- Volunteer Stats -->
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="font-medium text-gray-900 mb-3">Community Impact</h3>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">This Month</span>
                            <span class="font-medium">1,245 hours</span>
                        </div>
                        <!-- <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 75%"></div>
                        </div> -->
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">This Year</span>
                            <span class="font-medium">12,893 hours</span>
                        </div>
                        <!-- <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: 60%"></div>
                        </div> -->
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">Total Volunteers</span>
                            <span class="font-medium">8,742</span>
                        </div>
                        <!-- <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-purple-500 h-2 rounded-full" style="width: 85%"></div>
                        </div> -->
                    </div>
                </div>
                <div class="mt-4 p-3 bg-blue-50 rounded-lg text-center">
                    <p class="text-sm text-blue-700">You've contributed <span class="font-bold">42 hours</span> this month!</p>
                </div>
            </div>

            <!-- Volunteer Resources -->
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="font-medium text-gray-900 mb-3">Volunteer Resources</h3>
                <div class="space-y-3">
                    <a href="#" class="flex items-center p-2 rounded-lg hover:bg-gray-50 transition">
                        <div class="bg-blue-100 p-2 rounded-lg mr-3">
                            <i class="fas fa-book text-blue-500"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Volunteer Handbook</p>
                            <p class="text-xs text-gray-500">Guide to getting started</p>
                        </div>
                    </a>
                    <a href="#" class="flex items-center p-2 rounded-lg hover:bg-gray-50 transition">
                        <div class="bg-green-100 p-2 rounded-lg mr-3">
                            <i class="fas fa-video text-green-500"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Training Videos</p>
                            <p class="text-xs text-gray-500">Learn best practices</p>
                        </div>
                    </a>
                    <a href="#" class="flex items-center p-2 rounded-lg hover:bg-gray-50 transition">
                        <div class="bg-purple-100 p-2 rounded-lg mr-3">
                            <i class="fas fa-file-alt text-purple-500"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Safety Guidelines</p>
                            <p class="text-xs text-gray-500">Stay safe while helping</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Volunteer of the Month -->
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <h3 class="font-medium text-gray-900 mb-3">Volunteer of the Month</h3>
                <img src="Assets\karsten-winegeart-ZAiuJXbF7dA-unsplash.jpg" alt="Volunteer of the month" class="w-20 h-20 rounded-full mx-auto mb-3">
                <h4 class="font-medium text-gray-900">Karsten Winegeart</h4>
                <p class="text-sm text-gray-600 mb-2">Dedicated 120 hours this month</p>
                <div class="flex justify-center mb-3">
                    <span class="text-yellow-400"><i class="fas fa-star"></i></span>
                    <span class="text-yellow-400"><i class="fas fa-star"></i></span>
                    <span class="text-yellow-400"><i class="fas fa-star"></i></span>
                    <span class="text-yellow-400"><i class="fas fa-star"></i></span>
                    <span class="text-yellow-400"><i class="fas fa-star"></i></span>
                </div>
                <button class="text-blue-500 text-sm font-medium hover:text-blue-700">
                    Read his journey
                </button>
            </div>
            </div>
        </div>
    </div>

</x-app-layout>