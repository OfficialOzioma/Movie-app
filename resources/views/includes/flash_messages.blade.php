@if (session('status'))
    @if (session('status') == 'success')
        <div role="alert" class=" w-1/2" id="alert">
            <div class="bg-green-500 text-white font-bold rounded-t px-4 py-2">
                <button class=" float-right mt-0 text-white-50"
                    onclick="document.getElementById('alert').style.display = 'none'">X</button>
                <p class="text-left"> Success</p>

            </div>
            <div class="border border-t-0 border-green-400 rounded-b bg-green-100 px-4 py-3 text-dark">
                <p class="text-left"><strong>{{ session('message') }}</strong></p>
            </div>
        </div>
    @endif
    @if (session('status') == 'warning')
        <div role="alert">
            <div class="bg-yellow-500 text-white font-bold rounded-t px-4 py-2">
                Warning
            </div>
            <div class="border border-t-0 border-yellow-400 rounded-b bg-yellow-100 px-4 py-3 text-white">
                <p><strong>{{ session('message') }}</strong></p>
            </div>
        </div>
    @endif
    @if (session('status') == 'error')
        <div role="alert">
            <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                Error !
            </div>
            <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-white">
                <p><strong>{{ session('message') }}</strong></p>
            </div>
        </div>
    @endif
    @if (session('status') == 'failure')
        <div role="alert">
            <div class="bg-purple-500 text-white font-bold rounded-t px-4 py-2">
                Error !
            </div>
            <div class="border border-t-0 border-purple-400 rounded-b bg-purple-100 px-4 py-3 text-white">
                <p><strong>{{ session('message') }}</strong></p>
            </div>
        </div>
    @endif
@endif

<script>
    // time out

    setTimeout(function() {
        document.getElementById('alert').style.display = 'none';
    }, 1000);
</script>
