{{-- resources/views/profile/experience-edit.blade.php --}}
<div class="p-6 md:p-8 max-h-[80vh] overflow-y-auto">
    <div class="flex justify-between items-center border-b pb-3 mb-4">
        <h2 class="text-2xl font-bold text-gray-900">Edit Experience</h2>
        <button @click="openModal = null" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
    </div>

    <form action="{{ route('experience.update', $experience) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="space-y-6">
            {{-- Title --}}
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $experience->title) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>

            {{-- All other form fields pre-filled with $experience data --}}
            <div>
                <label for="organization" class="block text-sm font-medium text-gray-700">Organization (Optional)</label>
                <input type="text" name="organization" id="organization" value="{{ old('organization', $experience->organization) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date <span class="text-red-500">*</span></label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $experience->start_date) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700">End Date (Leave blank if current)</label>
                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $experience->end_date) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description (Optional)</label>
                <textarea name="description" id="description" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('description', $experience->description) }}</textarea>
            </div>
        </div>

        <div class="flex justify-end space-x-4 pt-6 mt-6 border-t">
            <button type="button" @click="openModal = null" class="bg-gray-200 text-gray-800 font-bold py-2 px-4 rounded-lg hover:bg-gray-300 transition">Cancel</button>
            <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition">Save Changes</button>
        </div>
    </form>
</div>