@extends('layout.app')
@section('content')
    <div class="actor-info">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <div class="flex-none">

                <img src="{{'https://image.tmdb.org/t/p/w500/'.$actors['profile_path'] }}" class="w-72" alt="">
            </div>
            <div class="md:ml-12">
                <h2 class="text-4xl font-semibold text-white">{{ $actors['name'] }}</h2>
                <div class="flex item-center text-gray-400 text-sm mt-3">
                    <span>
                        {{ \Carbon\Carbon::parse($actors['birthday'])->format('M d, y') }}
                        ({{ \Carbon\Carbon::parse($actors['birthday'])->age}} years old) in {{ $actors['place_of_birth'] }}
                    </span>
                </div>
                <div class="mt-2">
                    <h5 class="text-4xl font-semibold text-white">Biography</h5>
                    <p class="text-gray-100 mt-4">{{ $actors['biography'] }}</p>
                </div>
                <div class="knowfor">
                    <h4 class="text-2xl text-white font-semibold mt-12">Known For</h4>
                    <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-8">

                        @foreach ($actors['combined_credits']['cast'] as $cast)

                            @if ($loop->index <6)
                                <div class="mt-4">
                                    @if ($cast['poster_path'] !== null)
{{--                                        @dd($cast)--}}
                                        @if ($cast['media_type'] == 'movie')
                                            <a href="{{ route('movie.show', $cast['id']) }}">
                                                <img src="{{'https://image.tmdb.org/t/p/w500/'.$cast['poster_path'] }}" class="w-72 hover:opacity-50 transition ease-in-out duration-150 rounded-lg" alt="">
                                            </a>
                                            <a href="{{ route('movie.show', $cast['id']) }}" class="text-sm text-white text-center text-semibold hover:text-yellow-500 nt-3">{{ $cast['original_title'] }}</a>
                                        @else
                                            <a href="{{ route('tv.show', $cast['id']) }}">
                                                <img src="{{'https://image.tmdb.org/t/p/w500/'.$cast['poster_path'] }}" class="w-72 hover:opacity-50 transition ease-in-out duration-150 rounded-lg" alt="">
                                            </a>
                                            <a href="{{ route('tv.show', $cast['id']) }}" class="text-sm text-white text-center text-semibold hover:text-yellow-500 nt-3">{{ $cast['original_title'] ?? '' }}</a>
                                        @endif
                                    @else
                                        @if ($cast['media_type'] == 'movie')
                                            <a href="{{ route('movie.show', $cast['id']) }}">
                                                <img src="http://placehold.jp/300x450.png" class="w-72 hover:opacity-50 transition ease-in-out duration-150 rounded-lg" alt="">
                                            </a>
                                            <a href="{{ route('movie.show', $cast['id']) }}" class="text-sm text-white text-center text-semibold hover:text-yellow-500 nt-3">{{ $cast['original_title'] }}</a>
                                        @else
                                            <a href="{{ route('tv.show', $cast['id']) }}">
                                                <img src="http://placehold.jp/300x450.png" class="w-72 hover:opacity-50 transition ease-in-out duration-150 rounded-lg" alt="">
                                            </a>
                                            <a href="{{ route('tv.show', $cast['id']) }}" class="text-sm text-white text-center text-semibold hover:text-yellow-500 nt-3">{{ $cast['original_title'] }}</a>
                                        @endif
                                    @endif
                                </div>
                            @endif

                        @endforeach
                    </div>
                </div>
                <div class="credit-info mt-5">
                    <h4 class="text-2xl text-white font-semibold">Credits</h4>
                    <div class="bg-gray-700 shadow-xl rounded-lg">
                        <ul class="divide-y divide-gray-800">
                            @foreach ($actors['combined_credits']['cast'] as $credit)
                                @if (isset($credit['release_date']) && isset($credit['title']))
                                    <li class="p-2 hover:bg-gray-800 text-white">{{ \Carbon\Carbon::parse($credit['release_date'])->format('Y') }} <strong><a href="{{ route('movie.show', $credit['id']) }}" class="hover:underline">{{ $credit['title'] }}</a></strong> as {{ $credit['character'] }}</li>
                                @elseif(isset($credit['first_air_date']) && isset($credit['name']))
                                    <li class="p-2 hover:bg-gray-800 text-white">{{ \Carbon\Carbon::parse($credit['first_air_date'])->format('Y') }} <strong><a href="{{ route('tv.show', $credit['id']) }}" class="hover:underline">{{ $credit['name'] }}</a></strong> as {{ $credit['character'] }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
