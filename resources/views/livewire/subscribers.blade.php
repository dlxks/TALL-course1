<div>
    <h2 class="text-2xl font-bold mb-4">Subscribers</h2>

    @if (session()->has('message'))
    <div class="mb-4 text-green-600">
        {{ session('message') }}
    </div>
    @endif

    <!-- Search input -->
    <div class="mb-4 flex justify-end">
        <x-text-input type="text" placeholder="Search users here..."
            class="border border-gray-300 rounded px-3 py-2 w-1/3" wire:model.live.debounce.300ms="search" />
    </div>

    <!-- Table -->
    <table class="w-full border-collapse">
        <thead class="border-b-2 border-gray-200 text-indigo-700 text-sm">
            <tr>
                <th class="py-2 font-bold text-left">Email</th>
                <th class="py-2 font-bold text-left">Verified</th>
                <th class="py-2 font-bold text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($subscribers as $subscriber)
            <tr class="odd:bg-gray-100">
                <td class="py-2 px-4 text-sm border-b border-gray-200">{{ $subscriber->email }}</td>
                <td class="py-2 px-4 text-sm text-gray-500 border-b border-gray-200">
                    @if ($subscriber->email_verified_at)
                    {{ $subscriber->email_verified_at->diffForHumans() }}
                    @else
                    <span class="italic text-red-500">Not verified</span>
                    @endif
                </td>
                <td class="py-2 px-4 border-b border-gray-200">
                    <button class="text-red-500 border border-red-500 bg-red-50 hover:bg-red-100 px-2 py-1 rounded"
                        wire:click="delete({{ $subscriber->id }})"
                        onclick="return confirm('Are you sure you want to delete this subscriber?')">
                        Delete
                    </button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="py-4 text-center text-sm text-gray-500">
                    No subscribers found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $subscribers->links() }}
    </div>
</div>