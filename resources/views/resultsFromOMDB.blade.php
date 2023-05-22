<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Results from Movies In OMDB') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
{{--                    {{ $result }}--}}
                    <form method="post" action="{{ route('savemovie') }}">
                        @csrf
                        <label>Title</label>
                        <input type="text" name="title" value="{{$result['Title']}}" readonly/>
                        <br>
                        <label>Release Year</label>
                        <input type="text" name="release" value="{{$result['Year']}}" readonly/>
                        <br>
                        <img src="{{$result['Poster']}}" width="200px">
                        <input type="hidden" name="posterlink" value="{{$result['Poster']}}"/>
                        <input type="hidden" name="casts" value="{{$result['Actors']}}"/>
                        <input type="hidden" name="genre" value="{{$result['Genre']}}"/>
                        <br>
                        <label>Subscription Type</label>
                        <select name="subscriptiontype">
                            <option value=""> Select</option>
                            @foreach ($subscriptionTypes as $subscriptionType)
                                <option value="{{$subscriptionType->id}}"> {{$subscriptionType->name}}</option>
                            @endforeach
                        </select>
                        <br>
                        <label>Rent Period(number of day)</label>
                        <input type="number" name="rent_period" />
                        <br>
                        <label>Rent Price</label>
                        <input type="number" name="rent_price" />
                        <br>
                        <label>License Start</label>
                        <input type="date" name="license_start" />
                        <br>
                        <label>Subscription End</label>
                        <input type="date" name="license_end" />
                        <br>

                        <x-button class="ml-3">
                            {{ __('Save') }}
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
