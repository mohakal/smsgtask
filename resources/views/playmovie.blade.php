<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View All Movies') }}
        </h2>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                   @if($show_movie==true)
                       Movie Playing
                       <img src="{{ $movie->poster_link }}">
                    @else
                    Sorry You Have to upgrade subcription or need to take movie in rent.
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
