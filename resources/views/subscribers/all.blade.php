<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Subscribers') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <h2 class="text-2xl font-bold mb-4">All Subscribers</h2>
          <ul class="list-disc pl-5">
            @forelse($subscribers as $subscriber)
            <li>{{ $subscriber->email }}</li>
            @empty
            <li>No subscribers found.</li>
            @endforelse
          </ul>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>