<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div>
                            <label for="name">Event Name:</label>
                            <input type="text" id="name" name="name" value="{{ $event->name }}" class="w-full rounded-lg bg-gray-300 dark:bg-gray-700 text-black dark:text-white">
                        </div>

                        <!-- Date and Time -->
                        <div>
                            <label for="date">Event Date and Time:</label>
                            <input type="datetime-local" id="date" name="date" value="{{ \Carbon\Carbon::parse($event->date)->format('Y-m-d\TH:i') }}" class="w-full rounded-lg bg-gray-300 dark:bg-gray-700 text-black dark:text-white">
                        </div>

                        <!-- Location -->
                        <div>
                            <label for="location">Location:</label>
                            <input type="text" id="location" name="location" value="{{ $event->location }}" class="w-full rounded-lg bg-gray-300 dark:bg-gray-700 text-black dark:text-white">
                        </div>

                        <!-- Type -->
                        <div>
                            <label for="type">Event Type:</label>
                            <input type="text" id="type" name="type" value="{{ $event->type }}" class="w-full rounded-lg bg-gray-300 dark:bg-gray-700 text-black dark:text-white">
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description">Description:</label>
                            <textarea id="description" name="description" class="w-full rounded-lg bg-gray-300 dark:bg-gray-700 text-black dark:text-white">{{ $event->description }}</textarea>
                        </div>

                        <!-- VIP -->
                        <div>
                            <label for="is_vip">VIP Event:</label>
                            <input type="checkbox" id="is_vip" name="is_vip" {{ $event->is_vip ? 'checked' : '' }} class="dark:bg-gray-700">
                        </div>

                        <!-- Image -->
                        <div>
                            <label for="image">Event Image:</label>
                            <input type="file" id="image" name="image" class="w-full rounded-lg bg-gray-300 dark:bg-gray-700 text-black dark:text-white">
                            <img src="{{ asset($event->image ? $event->image : 'path/to/default/image.jpg') }}" alt="{{ $event->name }}" class="mt-4 w-32">
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Update Event</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
