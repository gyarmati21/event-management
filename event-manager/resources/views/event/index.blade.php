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
                        <div class="flex items-start mb-6 p-6 shadow-lg border border-gray-200 bg-white dark:bg-gray-800 relative">
                            <div class="w-1/4">
                                <img src="{{ $event->image ? asset($event->image) : asset('path/to/default/image.jpg') }}" alt="{{ $event->name }}" class="w-full h-auto rounded-lg">
                            </div>
                            
                            <div class="flex-grow pl-4">
                                <div class="flex justify-between mb-2">
                                    <div class="flex flex-col w-3/4">
                                        <h4 class="text-xl font-semibold">{{ $event->name }}</h4>
                                        <div class="flex space-x-4 mt-1">
                                            <span class="text-gray-600">{{ $event->type }}</span>
                                            <span class="text-gray-500">{{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}</span>
                                            <span class="text-gray-500">{{ $event->location }}</span>
                                        </div>
                                    </div>
                                    <div class="w-1/6 text-right">
                                        @if (auth()->user() && !$event->users->contains(auth()->user()))
                                            <form action="{{ route('events.join', $event->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-4 py-2 bg-gray-700 text-white font-bold  shadow hover:bg-orange-500 hover:shadow-lg transition-all">
                                                    Join
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-green-500">Joined</span>
                                        @endif
                                    </div>
                                </div>
                                <p class="mt-4">{{ $event->description }}</p>
                            </div>
                            
                            <div class="absolute bottom-0 right-0 pr-4 pb-4">
                                <p class="text-gray-400">Users joined: {{ $event->joinedUserCount() }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
