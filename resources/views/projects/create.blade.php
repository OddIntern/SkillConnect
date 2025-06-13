{{-- This file should ONLY contain the form's HTML, with no <x-app-layout> --}}

<div class="p-6 md:p-8 max-h-[80vh] overflow-y-auto">
    <div class="flex justify-between items-center border-b pb-3 mb-4">
        <h2 class="text-2xl font-bold text-gray-900">Create New Volunteer Opportunity</h2>
        {{-- We add a close button for usability inside the loaded content --}}
        <button @click="openModal = null" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
    </div>

    {{-- Display Validation Errors (if any) --}}
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-400 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('projects.store') }}" method="POST">
        @csrf
        <div class="space-y-6">
            {{-- Title --}}
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
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


        </div>
        <div class="flex justify-end space-x-4 pt-6 mt-6 border-t">
            <button type="button" @click="openModal = null" class="bg-gray-200 text-gray-800 font-bold py-2 px-4 rounded-lg hover:bg-gray-300 transition">Cancel</button>
            <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition">Post Opportunity</button>
        </div>
    </form>
</div>