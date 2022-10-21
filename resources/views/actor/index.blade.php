@extends('layout.app')
@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="popular-actor">
            <h2 class="capitalize text-white text-lg font-semibold">Popular Actors</h2>
            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-7 gap-3">
            @foreach ($actors as $actor)
                    <div class="actor mt-8">
                        <a href="{{ route('actor.show', $actor['id']) }}">
                            @if ($actor['profile_path'] !== null)
                                <img src="{{'https://image.tmdb.org/t/p/w500/' . $actor['profile_path']}}" alt="" class="hover:opacity-50 transition ease-in-out duration-150 rounded-lg"/>
                            @else
                                <img src="http://placehold.jp/300x450.png" alt="" class="hover:opacity-50 transition ease-in-out duration-150 rounded-lg"/>
                            @endif
                        </a>
                        <div class="mt-2">
                            <a href="{{ route('actor.show', $actor['id']) }}" class="text-md pt-4 text-white font-semibond hover:text-yellow-500">{{$actor['name']}}</a>
                            <div class="text-gray-400 text-sm truncate">
                                <span>{{ collect($actor['known_for'])->pluck('title')->implode(', ') }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.js"></script>
    <script>
        const elem = document.querySelector('.grid');
        const infScroll = new InfiniteScroll( elem, {
            path: '/actor/page/@{{#}}',
            append: '.actor'
        });
    </script>
@endsection
