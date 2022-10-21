<!DOCTYPE html>
<html>

<head>
    <title>Sign up / Login</title>
    <link href="/css/auth.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>

<body>

    <div class="main">

        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="signup">

            <form method="post" action="{{ route('signup') }}">
                {{ csrf_field() }}
                <label for="chk" aria-hidden="true">Click to Sign up</label>
                @if (session('status'))
                    @if (session('status') == 'error')
                        <div class="message">
                            <strong>{{ session('message') }}</strong>
                        </div>
                    @endif
                @endif
                <input type="text" name="name" placeholder="Enter your Fullname" required>

                <input type="email" name="email" placeholder="Enter your Email Address" required>
                <input type="password" name="password" placeholder="Enter your Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm your Password" required>
                <button type="submit">Register</button>
            </form>
            <br />
        </div>

        <div class="login">
            <form method="post" action="{{ route('authenticate') }}">
                {{ csrf_field() }}
                <label for="chk" aria-hidden="true">Click to Login</label>
                <input type="email" name="email" placeholder="Enter your Email" required>
                <input type="password" name="password" placeholder="Enter your Password" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>

</html>
<!-- partial -->

</body>

</html>
