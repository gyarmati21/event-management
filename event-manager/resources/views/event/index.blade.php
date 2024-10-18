<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Events') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-4">All Events</h3>
                    @foreach ($events as $event)
                        <div class="flex items-start mb-6 border-2 border-white p-4 shadow-md">
                            <!-- Event Image -->
                            <div class="w-1/3">
                                <img src="{{ $event->image ? asset('storage/' . $event->image) : asset('path/to/default/image.jpg') }}" alt="{{ $event->name }}" class="w-full h-auto rounded-lg">
                            </div>
                            <!-- Event Details -->
                            <div class="w-2/3 pl-4">
                                <h4 class="text-xl font-semibold">{{ $event->name }}</h4>
                                <p class="text-gray-600 mb-1">{{ $event->type }}</p>
                                <p class="text-gray-500 mb-2">{{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}</p>
                                <p class="mb-2">{{ $event->description }}</p>
                                <p class="text-gray-400">Created by: <strong>{{ $event->creator->name }}</strong></p>
                                <p class="text-gray-400">Users joined: {{ $event->joinedUserCount() }}</p>

                                <!-- If user is logged in and hasn't joined the event, show the Join button -->
                                @if (auth()->user() && !$event->users->contains(auth()->user()))
                                    <form action="{{ route('events.join', $event->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary mt-2">
                                            Join Event
                                        </button>
                                    </form>
                                @else
                                    <span class="text-green-500 mt-2">Already Joined</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
