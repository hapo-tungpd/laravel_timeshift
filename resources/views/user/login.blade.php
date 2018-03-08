<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>Haposoft</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Haposoft login"
    />
    <script type="application/x-javascript">
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- Meta tag Keywords -->
    <!-- css files -->
    <link rel="stylesheet" href="{{ asset('css/style-login.css') }}" type="text/css" media="all" />
    <!-- Style-CSS -->
    <link rel="stylesheet"  href="{{ asset('css/font-awesome.css') }}">
    <!-- Font-Awesome-Icons-CSS -->
    <!-- //css files -->
    <!-- online-fonts -->
    <link href="//fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <!-- //online-fonts -->
</head>

<body>
<!--header-->
<div class="header-w3l">
    <h1>
        <span>U</span>ser
        <span>L</span>ogin
        <span>F</span>orm</h1>
</div>
<!--//header-->
<div class="main-content-agile">
    <div class="sub-main-w3">
        <h2>Login Here</h2>
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="pom-agile">
                <span class="fa fa-user-o" aria-hidden="true"></span>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="pom-agile">
                <span class="fa fa-key" aria-hidden="true"></span>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="sub-w3l">
                <div class="sub-agile">
                    <input type="checkbox" id="brand1" value="">
                    <label for="brand1">
                        <span></span>Remember me</label>
                </div>
                <a href="{{ route('password.request') }}">Forgot Password?</a>
                <div class="clear"></div>
            </div>
            <div class="right-w3l">
                <input type="submit" value="Login">
            </div>
            <div class="right-w31 admin-login">
                <a href="{{ route('admin.login-form') }}">You are Admin?</a>
            </div>
        </form>
    </div>
</div>
<!--//main-->
<!--footer-->
<div class="footer">
    <p>&copy; 2018 User login | Design by
        <a href="https://haposoft.com/vi">Haposoft</a>
    </p>
</div>
<!--//footer-->
</body>

</html>