<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit idea') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('ideas.update', $idea) }}">
                        @csrf @method('PUT')
                        <div class="mb-3">
                            <textarea name="message" class="block bg-transparent w-full rounded-md border-gray-500" placeholder="{{__('What\'s on your mind?')}}">{{ old('message', $idea->message) }}</textarea>
                        </div>
                        <x-input-error :messages="$errors->get('message')" class="mt-2"/>
                        <div>
                            <x-primary-button class="mt-4">{{__('Edit idea')}}</x-primary-button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>