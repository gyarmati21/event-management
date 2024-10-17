<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Event Name -->
                        <div>
                            <label for="name">{{ __('Event Name') }}</label>
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        </div>

                        <!-- Event Date -->
                        <div class="mt-4">
                            <label for="date">{{ __('Event Date') }}</label>
                            <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date')" required />
                        </div>

                        <!-- Location -->
                        <div class="mt-4">
                            <label for="location">{{ __('Location') }}</label>
                            <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location')" required />
                        </div>

                        <!-- Image -->
                        <div class="mt-4">
                            <label for="image">{{ __('Event Image') }}</label>
                            <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" />
                        </div>

                        <!-- Type -->
                        <div class="mt-4">
                            <label for="type">{{ __('Event Type') }}</label>
                            <x-text-input id="type" class="block mt-1 w-full" type="text" name="type" :value="old('type')" required />
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <label for="description">{{ __('Event Description') }}</label>
                            <textarea id="description" class="block mt-1 w-full" name="description" required>{{ old('description') }}</textarea>
                        </div>

                        <!-- VIP Checkbox -->
                        <div class="mt-4">
                            <label for="is_vip">{{ __('VIP Event') }}</label>
                            <x-text-input id="is_vip" class="block mt-1" type="checkbox" name="is_vip" :value="old('is_vip')" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Create Event') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
