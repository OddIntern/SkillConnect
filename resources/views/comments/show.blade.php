<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- 🧩 Bagian Kiri: Detail Proyek --}}
        <div class="bg-white shadow rounded-xl p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $project->title }}</h2>
            <p class="text-gray-600 mb-4">{{ $project->description }}</p>

            <ul class="text-gray-500 text-sm space-y-2">
                <li><strong>Organisasi:</strong> {{ $project->organization_name }}</li>
                <li><strong>Status:</strong> {{ $project->status }}</li>
                <li><strong>Lokasi:</strong> {{ $project->location_address }}</li>
                <li><strong>Relawan Dibutuhkan:</strong> {{ $project->volunteers_needed }}</li>
                <li><strong>Dibuat oleh:</strong> {{ $project->user->name }}</li>
            </ul>
        </div>

        {{-- 💬 Bagian Kanan: Komentar --}}
        <div class="bg-white shadow rounded-xl p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Komentar</h3>

            {{-- 🔁 Daftar Komentar --}}
            {{-- Bagian ini yang ditambahkan properti scroll --}}
            <div class="space-y-4 mb-6 max-h-96 overflow-y-auto">
                @forelse ($project->comments as $comment)
                    <div class="border border-gray-200 p-3 rounded-lg">
                        <p class="text-sm text-gray-800">
                            <strong>{{ $comment->user->name }}</strong> mengatakan:
                        </p>
                        <p class="text-gray-600 mt-1">{{ $comment->content }}</p>
                        <p class="text-xs text-gray-400 mt-1">{{ $comment->created_at->diffForHumans() }}</p>
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada komentar.</p>
                @endforelse
            </div>

            {{-- 📝 Form Tambah Komentar --}}
            <form action="{{ route('comments.store', $project->id) }}" method="POST" class="mt-4">
                @csrf
                <textarea name="comment" class="w-full p-2 border rounded" rows="3" placeholder="Add a comment..."></textarea>
                <button type="submit" class="mt-2 px-4 py-2 bg-green-500 text-white rounded">Submit</button>
            </form>
        </div>

    </div>
</x-app-layout>
