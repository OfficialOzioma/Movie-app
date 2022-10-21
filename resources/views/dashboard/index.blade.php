@extends('layout.app')
@section('content')

    <div class="min-h-full">

        <header class="bg-gray-900 shadow">
            <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-white">Dashboard</h1>
            </div>
        </header>
        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <!-- Replace with your content -->
                <div class="px-4 py-6 sm:px-0">
                    <div class="h-auto rounded-lg border-4 border-dashed border-gray-200 text-center">
                        {{-- @dd($data) --}}
                        {{-- movies --}}
                        @include('includes.flash_messages')

                        @if (count($movies) == 0)
                            <div class="text-center m-10">
                                <h2>
                                    <p class="text-3xl  font-bold tracking-tight text-white">
                                        You don't have any movies in your list
                                    </p>
                                </h2>
                                <br />
                                <h3>
                                    <button type="button"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-base px-6 py-3.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <a href="{{ route('movie.index') }}">Add movies</a>
                                    </button>
                                </h3>
                            </div>
                        @else
                            <p class="text-3xl m-6 font-bold tracking-tight text-white">
                                Your Movie list
                            </p>
                            <div class="grid gap-4 grid-cols-3">

                                @foreach ($movies as $movie)
                                    <div
                                        class="max-w-sm bg-white m-8 rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">

                                        <a href="#">
                                            <img class="hover:opacity-50 transition ease-in-out duration-150 rounded-t-lg"
                                                src="{{ 'https://image.tmdb.org/t/p/w500/' . $movie['backdrop_path'] }}"
                                                alt="" />
                                        </a>
                                        <div class="p-5">
                                            <a href="#">
                                                <h5
                                                    class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                                    {{ $movie['title'] }}
                                                </h5>
                                            </a>
                                            <p class="mb-3 font-normal text-gray-700 text-left dark:text-gray-400">
                                                {{ $movie['overview'] }}</p>

                                            <div class="flex justify-between items-center">
                                                <a href="{{ route('movie.show', $movie['movie_id']) }}"
                                                    class="inline-flex items-center py-2 px-3 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    more details
                                                </a>

                                                <button type="button" id="deleteBtn_{{ $movie['movie_id'] }}"
                                                    onclick="deleteMovie({{ $movie['movie_id'] }})"
                                                    class="inline-flex items-center py-2 px-3 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    Delete from List
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        @endif






                    </div>
                </div>
                <!-- /End replace -->
            </div>
        </main>
    </div>
@endsection

@section('script')
    <script>
        function deleteMovie(movie_id) {

            console.log(movie_id);
            // var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('movie_list.delete') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    movie_id: movie_id,
                },
                beforeSend: function() {
                    $('#deleteBtn_' + movie_id).html(`
                     <button type="button" class="inline-flex items-center py-2 px-3 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Deleting ...
                    </button>
                    `);
                },
                success: function(response) {
                    console.log(response);
                    // refresh page
                    window.location.reload();

                }
            })


        }
    </script>
@endsection
