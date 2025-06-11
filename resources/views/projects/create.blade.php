<x-app-layout>
    {{-- Slot for page-specific CSS --}}
    <x-slot name="styles">
        <link rel="stylesheet" href="{{ asset('css/new_post_styles.css') }}">
    </x-slot>

    <div class="flex-grow container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto bg-white p-6 sm:p-8 rounded-lg shadow-lg">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-6">Create New Volunteer Opportunity</h1>

            {{-- Display Validation Errors --}}
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-400 rounded">
                    <strong class="font-bold">Oops! Something went wrong.</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('projects.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
                @csrf {{-- CSRF Protection --}}

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="e.g., Beach Cleanup Drive">
                </div>


                <div>
                    <label for="organization_name" class="block text-sm font-medium text-gray-700">Organization Name (Optional)</label>
                    <input type="text" name="organization_name" id="organization_name" value="{{ old('organization_name') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="e.g., Ocean Conservation Society">
                    <p class="mt-1 text-xs text-gray-500">If this opportunity is on behalf of an organization, enter its name here.</p>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description" rows="4" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Describe the volunteer opportunity in detail...">{{ old('description') }}</textarea>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Category/Status</label>
                    <select id="status" name="status" required class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="" disabled {{ old('status') ? '' : 'selected' }}>Select a category/status</option>
                        <option value="Environmental" {{ old('status') == 'Environmental' ? 'selected' : '' }}>Environmental</option>
                        <option value="Education" {{ old('status') == 'Education' ? 'selected' : '' }}>Education</option>
                        <option value="Community" {{ old('status') == 'Community' ? 'selected' : '' }}>Community</option>
                        <option value="Animals" {{ old('status') == 'Animals' ? 'selected' : '' }}>Animals</option>
                        <option value="Health" {{ old('status') == 'Health' ? 'selected' : '' }}>Health</option>
                        <option value="Programming" {{ old('status') == 'Programming' ? 'selected' : '' }}>Programming</option>
                        <option value="Urgent" {{ old('status') == 'Urgent' ? 'selected' : '' }}>Urgent</option>
                        <option value="Open" {{ old('status') == 'Open' ? 'selected' : '' }}>Open</option>
                        <option value="Other" {{ old('status') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div>
                    <label for="schedule_details" class="block text-sm font-medium text-gray-700">Schedule Details</label>
                    <input type="text" name="schedule_details" id="schedule_details" value="{{ old('schedule_details') }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="e.g., Every Tuesday, 4 PM - 6 PM">
                    <p class="mt-1 text-xs text-gray-500">Be descriptive. Examples: "Sat, Jun 29", "5-10 hours/week", "Flexible", "Every Tue & Thu".</p>
                </div>


                <div>
                    <label for="location_address" class="block text-sm font-medium text-gray-700">Location</label>
                    <input type="text" name="location_address" id="location_address" value="{{ old('location_address') }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="e.g., Santa Monica Pier, CA or 'Remote'">
                </div>

                <div>
                    <label for="volunteers_needed" class="block text-sm font-medium text-gray-700">Number of Volunteers Needed</label>
                    <input type="number" name="volunteers_needed" id="volunteers_needed" value="{{ old('volunteers_needed') }}" min="1" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="e.g., 10">
                </div>

                <div>
                    <label for="skills_required" class="block text-sm font-medium text-gray-700">Skills Required (Optional)</label>
                    <input type="text" name="skills_required" id="skills_required" value="{{ old('skills_required') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="e.g., Teaching, First Aid, Coding (comma-separated)">
                    <p class="mt-1 text-xs text-gray-500">Separate skills with a comma. These will be displayed as tags.</p>
                </div>


                <div class="flex justify-end pt-4">
                    <button type="button" onclick="window.history.back();" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 mr-3">
                        Cancel
                    </button>
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-plus mr-2"></i>Post Opportunity
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>