@extends('layout.app')
@inject('helper', 'App\Helpers\Utils')
@section('content')
    <div class="container mx-auto px-4 pt-16">

        <div class="popular-movie pb-6">
            <h2 class="capitalize text-white text-lg font-semibold">Popular Movie</h2>
            <div class="grid grid-cols-1 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-8 gap-3">

                @foreach ($popularMovies as $movie)
                    @if ($loop->index < 16)
                        <div class="mt-8 relative">
                            <a href="{{ route('movie.show', $movie['id']) }}">
                                <img class="hover:opacity-50 transition ease-in-out duration-150 rounded-lg"
                                    src="{{ 'https://image.tmdb.org/t/p/w500/' . $movie['backdrop_path'] }}" alt="">
                            </a>
                            <span
                                class="ml-3 mt-3 border-2 border-yellow-500 rounded-full w-8 h-8 text-center absolute top-0 left-0 text-white font-semibold text-sm flex justify-center items-center">
                                {{ $movie['vote_average'] * 10 }} <small class="text-xs">%</small>
                            </span>
                            <div class="mt-2">
                                <a href="{{ route('movie.show', $movie['id']) }}"
                                    class="text-md pt-4 text-white font-semibond hover:text-yellow-500">{{ $movie['title'] }}</a>
                                <div class="flex items-center text-gray-400 text-sm">
                                    <span>{{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, y') }}</span>
                                </div>

                                <div class="flex items-center text-gray-400 text-sm mt-7">

                                    <input type="hidden" value="{{ $movie['id'] }}" name="movie_id" id="movie_id">
                                    <input type="hidden" value="{{ $movie['title'] }}" name="title"
                                        id="title_{{ $movie['id'] }}">
                                    <input type="hidden" value="{{ $movie['backdrop_path'] }}" name="backdrop_path"
                                        id="backdrop_path_{{ $movie['id'] }}">
                                    <input type="hidden" value="{{ $movie['poster_path'] }}" name="poster_path"
                                        id="poster_path_{{ $movie['id'] }}">
                                    <input type="hidden" value="{{ $movie['overview'] }}" name="overview"
                                        id="overview_{{ $movie['id'] }}">
                                    <input type="hidden" value="{{ $movie['release_date'] }}" name="release_date"
                                        id="release_date_{{ $movie['id'] }}">
                                    <input type="hidden" value="{{ $movie['vote_average'] }}" name="vote_average"
                                        id="vote_average_{{ $movie['id'] }}">
                                    @if (Auth::check())
                                        @if ($helper->checkMoviesList($movie['id']) == true)
                                            <span>
                                                <button
                                                    class="py-2 px-3 text-xs font-medium text-center text-white bg-green-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                                    disabled>
                                                    Added
                                                </button>
                                            </span>
                                        @else
                                            <span id="addToList_{{ $movie['id'] }}">
                                                <button onclick="addToList({{ $movie['id'] }})"
                                                    id="addToListButton_{{ $movie['id'] }}"
                                                    class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300  rounded-lg py-2 px-3 text-xs font-medium text-center mr-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">
                                                    Added to list
                                                </button>
                                            </span>
                                        @endif
                                    @endif



                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>

        <div class="popular-movie">
            <h2 class="capitalize text-white text-lg font-semibold">Upcoming Movie</h2>
            <div class="grid grid-cols-1 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-8 gap-3">

                @foreach ($upcomingMovies as $movie)
                    @if ($loop->index < 16)
                        <div class="mt-8 relative">
                            <a href="{{ route('movie.show', $movie['id']) }}">
                                <img class="hover:opacity-50 transition ease-in-out duration-150 rounded-lg"
                                    src="{{ 'https://image.tmdb.org/t/p/w500/' . $movie['backdrop_path'] }}"
                                    alt="">
                            </a>
                            <span
                                class="ml-3 mt-3 border-2 border-yellow-500 rounded-full w-8 h-8 text-center absolute top-0 left-0 text-white font-semibold text-sm flex justify-center items-center">
                                {{ $movie['vote_average'] * 10 }} <small class="text-xs">%</small>
                            </span>
                            <div class="mt-2">
                                <a href="{{ route('movie.show', $movie['id']) }}"
                                    class="text-md pt-4 text-white font-semibond hover:text-yellow-500">{{ $movie['title'] }}</a>
                                <div class="flex items-center text-gray-400 text-sm">
                                    <span>{{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, y') }}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>

    </div>
@endsection
@section('script')
    <script>
        function addToList(id) {

            var title = $('#title_' + id).val();
            var poster_path = $('#poster_path_' + id).val();
            var vote_average = $('#vote_average_' + id).val();
            // var movie_id = $('#movie_id').val();
            var release_date = $('#release_date_' + id).val();
            var overview = $('#overview_' + id).val();
            var backdrop_path = $('#backdrop_path_' + id).val();
            console.log(id);
            console.log(vote_average);
            console.log(release_date);
            // var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('movie_list.save') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    title: title,
                    poster_path: poster_path,
                    vote_average: vote_average,
                    movie_id: id,
                    release_date: release_date,
                    overview: overview,
                    backdrop_path: backdrop_path
                },
                beforeSend: function() {
                    $('#addToListButton_' + id).attr('hidden', true);
                    $('#addToList_' + id).html(`
                    <button disabled type="button" class="py-2 px-3 text-xs font-medium text-center text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center">
                        <svg aria-hidden="true" role="status" class="inline mr-2 w-4 h-4 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2"/>
                        </svg>
                        Adding...
                    </button>
                    `);
                },
                success: function(response) {
                    console.log(response);
                    if (response["status"] == 'success') {
                        $('#addToList_' + id).html(
                            `<button type="button" class="py-2 px-3 text-xs font-medium text-center text-white bg-green-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" disabled>Added</button>`
                        );
                    } else {
                        alert(response["message"])
                        window.location.reload();
                    }


                }
            })


        }
    </script>
@endsection
