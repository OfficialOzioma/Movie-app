@extends('layout.app')
@section('content')
<div class="container mx-auto px-4 pt-16">
    <div class="popular-tv pb-6">
        <h2 class="capitalize text-white text-lg font-semibold">Popular TV Shows</h2>
        <div class="grid grid-cols-1 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-8 gap-3">
            @foreach ($popularTv as $tv)
                @if ($loop->index <16)
                    <div class="mt-8 relative">
                        @if ($tv['poster_path'] !== null)
                            <a href="{{ route('tv.show', $tv['id']) }}">
                                <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $tv['poster_path'] }}" class="hover:opacity-50 transition ease-in-out duration-150 rounded-lg" alt="">
                            </a>
                        @else 
                            <a href="{{ route('tv.show', $tv['id']) }}">
                                <img src="http://placehold.jp/300x450.png" class="hover:opacity-50 transition ease-in-out duration-150 rounded-lg" alt="">
                            </a>
                        @endif
                        <span class="ml-3 mt-3 border-2 border-yellow-500 rounded-full w-8 h-8 text-center absolute top-0 left-0 text-white font-semibold text-sm flex justify-center items-center">
                        {{ $tv['vote_average'] * 10 }} <small>%</small>
                        </span>
                        <div class="mt-2">
                            <a href="" class="text-md pt-4 text-white font-semibond hover:text-yellow-500">{{ $tv['name'] }}</a>
                            <div class="flex items-center text-gray-400 text-sm">
                                <span>{{ \Carbon\Carbon::parse($tv['first_air_date'])->format('M d, y') }}</span>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <div class="toprated-tv pb-6 mt-5">
        <h2 class="capitalize text-white text-lg font-semibold">Top Rated TV Shows</h2>
        <div class="grid grid-cols-1 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-8 gap-3">
            @foreach ($topRatedTv as $tv)
                @if ($loop->index <16)
                    <div class="mt-8 relative">
                        @if ($tv['poster_path'] !== null)
                            <a href="{{ route('tv.show', $tv['id']) }}">
                                <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $tv['poster_path'] }}" class="hover:opacity-50 transition ease-in-out duration-150 rounded-lg" alt="">
                            </a>
                        @else 
                            <a href="{{ route('tv.show', $tv['id']) }}">
                                <img src="http://placehold.jp/300x450.png" class="hover:opacity-50 transition ease-in-out duration-150 rounded-lg" alt="">
                            </a>
                        @endif
                        <span class="ml-3 mt-3 border-2 border-yellow-500 rounded-full w-8 h-8 text-center absolute top-0 left-0 text-white font-semibold text-sm flex justify-center items-center">
                        {{ $tv['vote_average'] * 10 }} <small>%</small>
                        </span>
                        <div class="mt-2">
                            <a href="" class="text-md pt-4 text-white font-semibond hover:text-yellow-500">{{ $tv['name'] }}</a>
                            <div class="flex items-center text-gray-400 text-sm">
                                <span>{{ \Carbon\Carbon::parse($tv['first_air_date'])->format('M d, y') }}</span>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection