<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Movie') }}
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
                    {{--                    {{ $result }}--}}
                    <form method="post" action="{{ route('updatemovie',['id'=>$result->id]) }}">
                        @csrf
                        <label>Title</label>
                        <input type="text" name="title" value="{{$result->title}}" readonly/>
                        <br>
                        <label>Release Year</label>
                        <input type="text" name="release" value="{{$result->release_year}}" readonly/>
                        <br>
                        <img src="{{$result->poster_link}}" width="200px">
                        <input type="text" name="posterlink" value="{{$result->poster_link}}"/>
                        <br>
                        <label>Casts</label>
                        <input type="text" name="casts" value="{{$result->casts}}"/>
                        <input type="hidden" name="old_casts" value="{{$result->casts}}"/>
                        <br>
                        <label>Tags</label>
                        <input type="text" name="genre" value="{{$result->tags}}"/>
                        <input type="hidden" name="old_genre" value="{{$result->tags}}"/>
                        <br>
                        <label>Subscription Type</label>
                        <select name="subscriptiontype">
                            <option value=""> Select</option>
                            @foreach ($subscriptionTypes as $subscriptionType)
                                <option value="{{$subscriptionType->id}}" @if ($subscriptionType->id==$result->subsciption_type_id) selected @endif> {{$subscriptionType->name}}</option>
                            @endforeach
                        </select>
                        <br>
                        <label>Rent Period(number of day)</label>
                        <input type="number" name="rent_period" value="{{ $result->rent_period }}" />
                        <br>
                        <label>Rent Price</label>
                        <input type="number" name="rent_price" value="{{ $result->rent_price }}"/>
                        <br>
                        <label>License Start</label>
                        <input type="date" name="license_start" value="{{ \Carbon\Carbon::parse($result->license_start)->format('Y-m-d') }}"/>
                        <br>
                        <label>Subscription End</label>
                        <input type="date" name="license_end" value="{{ \Carbon\Carbon::parse($result->license_end)->format('Y-m-d') }}"/>
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
