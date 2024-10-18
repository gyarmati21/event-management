<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Events') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-4">Events I Created</h3>
                    @foreach ($createdEvents as $event)
                        <div class="flex items-start mb-6 border-2 border-white rounded-lg p-4 shadow-md">
                            <!-- Event Image -->
                            <div class="w-1/3">
                                <img src="{{ $event->image ? asset('storage/' . $event->image) : asset('path/to/default/image.jpg') }}" alt="{{ $event->name }}" class="w-full h-auto rounded-lg">
                            </div>
                            <!-- Event Details -->
                            <div class="w-2/3 pl-4">
                                <h4 class="text-xl font-semibold">{{ $event->name }}</h4>
                                <p class="text-gray-600 mb-1">Joined by {{ $event->users->count() }} users</p>
                                <p class="text-gray-500 mb-2">{{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}</p>
                                <p class="mb-2">{{ $event->description }}</p>
                                <p class="text-gray-400">Location: <strong>{{ $event->location }}</strong></p>
                                <p class="text-gray-400">Type: <strong>{{ $event->type }}</strong> | VIP: <strong>{{ $event->is_vip ? 'Yes' : 'No' }}</strong></p>
                            </div>
                        </div>
                    @endforeach

                    <h3 class="text-2xl font-bold mb-4">Events I Joined</h3>
                    @foreach ($joinedEvents as $event)
                        <div class="flex items-start mb-6 border-2 border-white rounded-lg p-4 shadow-md">
                            <!-- Event Image -->
                            <div class="w-1/3">
                                <img src="{{ $event->image ? asset('storage/' . $event->image) : asset('path/to/default/image.jpg') }}" alt="{{ $event->name }}" class="w-full h-auto rounded-lg">
                            </div>
                            <!-- Event Details -->
                            <div class="w-2/3 pl-4">
                                <h4 class="text-xl font-semibold">{{ $event->name }}</h4>
                                <p class="text-gray-600 mb-1">Created by: {{ $event->creator->name }}</p>
                                <p class="text-gray-500 mb-2">{{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}</p>
                                <p class="mb-2">{{ $event->description }}</p>
                                <p class="text-gray-400">Location: <strong>{{ $event->location }}</strong></p>
                                <p class="text-gray-400">Type: <strong>{{ $event->type }}</strong> | VIP: <strong>{{ $event->is_vip ? 'Yes' : 'No' }}</strong></p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
