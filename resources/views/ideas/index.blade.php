<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Banco de Ideas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('ideas.store') }}">
                        @csrf
                        <div class="mb-3">
                            <textarea name="message" class="block bg-transparent w-full rounded-md border-gray-500" placeholder="{{__('What\'s on your mind?')}}">{{ old('message') }}</textarea>
                        </div>
                        <x-input-error :messages="$errors->get('message')" class="mt-2"/>
                        <div>
                            <x-primary-button class="mt-4">{{__('Add idea')}}</x-primary-button>
                        </div>
                        
                    </form>
                </div>
            </div>

            <div class="mt-6 bg-white dark:bg-gray-800 shadow-sm rounded-lg divide-y dark:divide-gray-900">
                @foreach ($ideas as $idea)
                <div class="p-6 flex space-x-2">
                    <svg class="h-6 w-6 text-green-800 dark:text-green-400 -scale-x-100" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 10-7.517 0c.85.493 1.509 1.333 1.509 2.316V18"></path>
                      </svg>
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-sky-800 dark:text-sky-300 text-md">
                                    {{ $idea->user->name}}
                                </span>
                                <small class="ml-2 text-md text-violet-600 dark:text-violet-400">{{__('Created ')}} {{ $idea->created_at->diffForHumans() }}</small>
                                @if ($idea->created_at != $idea->updated_at)
                                <small class="ml-2 text-md text-yellow-600 dark:text-yellow-400">{{__('Updated ')}} {{ $idea->updated_at->diffForHumans() }}</small>
                                @endif
                            </div>
                        </div>
                        <p class="mt-4 text-lg text-gray-900 dark:text-gray-100">{{ $idea->message }}</p>
                    </div>
                    @can ('update', $idea)
                    <x-dropdown>
                        <x-slot name="trigger">
                            <button>
                                <svg class="w-5 h-5 text-gray-900 dark:text-gray-200" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"></path>
                                  </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link class="flex" :href="route('ideas.edit', $idea)">
                                <svg class="w-5 h-5 mr-3 text-yellow-500 dark:text-yellow-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path>
                                </svg>
                                {{ __('Edit idea') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('ideas.destroy', $idea) }}">
                                @csrf @method('DELETE')
                                <x-dropdown-link class="flex" :href="route('ideas.destroy', $idea)" onclick="event.preventDefault(); this.closest('form').submit();">
                                    <svg class="w-5 h-5 mr-3 text-red-500 dark:text-red-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                    </svg>
                                    {{ __('Delete idea') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                    @endcan
                    
                </div>
                @endforeach 
            </div>

        </div>
    </div>
</x-app-layout>
