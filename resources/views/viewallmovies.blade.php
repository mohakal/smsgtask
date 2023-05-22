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
                    <form method="post" action="@if($usertype=='admin')
                    {{ route('searchmovie') }}
@else
{{ route('serachmoviebysubs') }}
@endif
">
                        @csrf
                        <label>Title/Tag</label>
                        <input type="text" name="searchterm"/>
                        <x-button class="ml-3">
                            {{ __('Search') }}
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table>
                        <tr>
                            <th>Title</th>
                            <th>Release Year</th>
                            <th>Poster</th>
                            <th>Subscription TYpe</th>
                            <th>Rent Period</th>
                            <th>Rent Price</th>
                            <th>License Start</th>
                            <th>License End</th>
                            <th>Casts</th>
                            <th>Tags</th>
                            <th>Action</th>
                        </tr>
                        @foreach($result as $movie)
                            <tr>
                                <td>{{ $movie->title }}</td>
                                <td>{{ $movie->release_year }}</td>
                                <td><img src="{{ $movie->poster_link }}" width="200px"></td>
                                <td>{{ $movie->subs }}</td>
                                <td>{{ $movie->rent_period }}</td>
                                <td>{{ $movie->rent_price }}</td>
                                <td>{{ $movie->license_start }}</td>
                                <td>{{ $movie->license_end }}</td>
                                <td>{{ $movie->casts }}</td>
                                <td>{{ $movie->tags }}</td>
                                <td>
                                    @if($usertype=='admin')
                                    <a href="{{ route("editmovie",['id'=>$movie->id]) }}">Edit </a>/ <a href="{{ route("deletemovie",['id'=>$movie->id]) }}">Delete</a>
                                    @else
                                        @if($movie->play==true)
                                            <a href="{{ route("playmovie",['id'=>$movie->id]) }}">Play</a>
                                        @else
                                            <a href="{{ route("rentmovie",['id'=>$movie->id]) }}">Rent</a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
