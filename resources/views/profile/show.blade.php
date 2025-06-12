<x-app-layout>
    {{-- This div now controls BOTH modals. `openModal` can be 'editProfile', 'addExperience', or null --}}
    <div x-data="{ openModal: null }" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        {{-- Success Message Display --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Profile Header Card (No changes here) --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
            <div>
                {{-- NOTE: We'll make this dynamic after adding a 'banner_path' to the users table --}}
                <img class="h-48 w-full object-cover" src="https://images.unsplash.com/photo-1504805572947-34fad45aed93?q=80&w=2070&auto=format&fit=crop" alt="Profile background">
            </div>
            <div class="p-6">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start">
                    <div class="flex items-start">
                        {{-- NOTE: We'll make this dynamic after adding an 'avatar_path' to the users table --}}
                        <img class="h-28 w-28 rounded-full border-4 border-white -mt-20" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=256&background=EBF4FF&color=7F9CF5" alt="{{ $user->name }}'s avatar">
                        <div class="mt-2 ml-4">
                            <h1 class="text-2xl font-bold text-gray-900">{{ $user->first_name }} {{ $user->last_name }}</h1>
                            <p class="text-sm text-gray-600">{{ $user->headline ?? 'No headline provided.' }}</p>
                            <p class="text-sm text-gray-500">{{ $user->location ?? 'Location not specified' }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-4 sm:mt-0">
                        {{-- CONDITIONAL LOGIC: Shows 'Edit' for your own profile, or 'Follow/Message' for others. --}}
                        @auth
                            @if (auth()->id() === $user->id)
                                <button @click.prevent="openModal = 'editProfile'" class="w-full sm:w-auto block bg-gray-100 text-gray-700 font-bold py-2 px-4 rounded-lg hover:bg-gray-200 transition text-sm text-center">
                                    <i class="fas fa-pencil-alt mr-2"></i> Edit Profile
                                </button>
                            @else
                                <div class="flex items-center space-x-2">
                                    <button class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition text-sm">
                                        <i class="fas fa-user-plus mr-1"></i> Follow
                                    </button>
                                    <button class="bg-white border border-gray-300 text-gray-700 font-bold py-2 px-4 rounded-lg hover:bg-gray-100 transition text-sm">
                                        <i class="fas fa-envelope mr-1"></i> Message
                                    </button>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        {{-- DYNAMIC 'About Me', 'Skills', and static 'Experience' --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="md:col-span-1 space-y-6">
                 <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">About Me</h3>
                    <p class="text-gray-600 text-sm">
                        {{ $user->about_me ?? 'This user has not written an about me section yet.' }}
                    </p>
                </div>
                 <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Skills</h3>
                    <div class="flex flex-wrap gap-2">
                        @forelse ($user->skills as $skill)
                            <span class="bg-sky-100 text-sky-800 text-sm font-medium py-1 px-3 rounded-full">{{ $skill->name }}</span>
                        @empty
                            <p class="text-sm text-gray-500">No skills listed yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="md:col-span-2">
                 <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold text-gray-800">Experience</h3>
                        {{-- This button now opens the new 'Add Experience' modal --}}
                        <button @click.prevent="openModal = 'addExperience'" class="text-blue-500 hover:text-blue-700 text-sm font-medium">
                            <i class="fas fa-plus-circle mr-1"></i> Add Experience
                        </button>
                    </div>
                    {{-- The dynamic loop for displaying experiences (No changes here) --}}
                    <div class="space-y-5">
                        @forelse ($user->experiences as $experience)
                            <div @if(!$loop->first) class="border-t pt-5" @endif>
                                <h4 class="font-semibold text-gray-700">{{ $experience->title }}</h4>
                                @if ($experience->organization)
                                    <p class="text-sm font-medium text-gray-600">{{ $experience->organization }}</p>
                                @endif
                                <p class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($experience->start_date)->format('F Y') }} - 
                                    @if ($experience->end_date)
                                        {{ \Carbon\Carbon::parse($experience->end_date)->format('F Y') }}
                                    @else
                                        Present
                                    @endif
                                </p>
                                @if ($experience->description)
                                    <p class="text-sm text-gray-600 mt-2">{{ $experience->description }}</p>
                                @endif
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">No experience has been added yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- DYNAMIC User's Activity / Projects Feed --}}
        <div>
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Activity</h3>
            <div class="space-y-6">
                @forelse ($user->projects as $project)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-5">
                            <div class="flex items-start space-x-4">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=128&background=EBF4FF&color=7F9CF5" class="w-12 h-12 rounded-lg object-cover" alt="User Avatar">
                                <div class="flex-1">
                                    <p class="text-sm font-medium">
                                        {{ $user->name }} created a new project · <span class="text-gray-500">{{ $project->created_at->diffForHumans() }}</span>
                                    </p>
                                    <h4 class="font-bold text-lg text-gray-800 hover:text-blue-600 cursor-pointer mt-1">{{ $project->title }}</h4>
                                    <p class="text-sm text-gray-500 mt-1">{{ Str::limit($project->description, 100) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white p-5 rounded-lg shadow-md text-center">
                        <p class="text-gray-500">{{ $user->name }} has not created any projects yet.</p>
                    </div>
                @endforelse
            </div>
        </div>


        <div x-show="openModal === 'editProfile'" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
            <div @click.away="openModal = null" class="bg-white rounded-lg shadow-xl max-w-lg w-full p-6 mx-4">
                {{-- Modal Header --}}
                <div class="flex justify-between items-center border-b pb-3 mb-4">
                    <h3 class="text-xl font-semibold">Edit Your Profile</h3>
                    <button @click="openModal = null" class="text-gray-400 hover:text-gray-600">&times;</button>
                </div>
                {{-- Main Edit Form --}}
                <form action="{{ route('public-profile.update', $user) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name <span class="text-red-500">*</span></label>
                                <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $user->first_name) }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name <span class="text-red-500">*</span></label>
                                <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $user->last_name) }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                        </div>
                        <div>
                            <label for="headline" class="block text-sm font-medium text-gray-700">Headline</label>
                            <input type="text" name="headline" id="headline" value="{{ old('headline', $user->headline) }}" placeholder="e.g., Volunteer Enthusiast" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                            <p class="mt-2 text-xs text-gray-500">Include a professional headline! such as 'Volunteer Enthusiast' or 'Coding Addict'</p>
                        </div>
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                            <input type="text" name="location" id="location" value="{{ old('location', $user->location) }}" placeholder="e.g., North Jakarta, Indonesia" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label for="about_me" class="block text-sm font-medium text-gray-700">About Me</label>
                            <textarea name="about_me" id="about_me" rows="4" class="mt-1 w-full rounded-md border-gray-300 shadow-sm" >{{ old('about_me', $user->about_me) }}</textarea>
                        </div>
                        <div>
                            <label for="skills" class="block text-sm font-medium text-gray-700">Skills</label>
                            <input type="text" name="skills" id="skills" value="{{ old('skills', $user->skills->pluck('name')->implode(', ')) }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm" placeholder="e.g., Laravel, PHP, Project Management">
                            <p class="mt-2 text-xs text-gray-500">Separate each skill with a comma. Tell us your top 5 most important skills!</p>
                        </div>
                    </div>
                    <div class="flex justify-between items-center mt-6 pt-4 border-t">
                        {{-- New button to switch to the 'Add Experience' modal --}}
                        <button type="button" @click="openModal = 'addExperience'" class="text-sm text-blue-600 hover:underline">Manage Experiences</button>
                        <div class="flex space-x-4">
                           <button type="button" @click="openModal = null" class="bg-gray-200 text-gray-800 font-bold py-2 px-4 rounded-lg hover:bg-gray-300 transition">Cancel</button>
                           <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div x-show="openModal === 'addExperience'" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
             <div @click.away="openModal = null" class="bg-white rounded-lg shadow-xl max-w-lg w-full p-6 mx-4">
                <div class="flex justify-between items-center border-b pb-3 mb-4">
                    <h3 class="text-xl font-semibold">Add New Experience</h3>
                    <button @click="openModal = null" class="text-gray-400 hover:text-gray-600">&times;</button>
                </div>
                {{-- Modal for adding a new experinece --}}
                <form action="{{ route('experience.store') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Title <span class="text-red-500">*</span></label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label for="organization" class="block text-sm font-medium text-gray-700">Organization (Optional)</label>
                            <input type="text" name="organization" id="organization" value="{{ old('organization') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date <span class="text-red-500">*</span></label>
                                <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700">End Date (Leave blank if current)</label>
                                <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                        </div>
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description (Optional)</label>
                            <textarea name="description" id="description" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-4 mt-6 pt-4 border-t">
                        <button type="button" @click="openModal = null" class="bg-gray-200 text-gray-800 font-bold py-2 px-4 rounded-lg hover:bg-gray-300 transition">Cancel</button>
                        <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition">Save Experience</button>
                    </div>
                </form>
             </div>
        </div>
        </div>
</x-app-layout>