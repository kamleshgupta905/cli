<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>VMH GROUP'S | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="{{ asset('assets') }}/login-assets/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet"
        href="{{ asset('assets') }}/login-assets/fonts/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets') }}/login-assets/fonts/flaticon/font/flaticon.css">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{ asset('assets') }}/login-assets/img/favicon.ico" type="image/x-icon">

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('assets') }}/login-assets/css/style.css">
    <style>
        .error-text,
        .text-logout {
            text-align: center;
            margin-bottom: 10px;
            color: red;
            font-size: 16px;
        }
    </style>
</head>

<body id="top">
    <div class="page_loader"></div>

    <div class="login-8" style="background-color: #f7f7f7;">
        <div class="container">
            <div class="row login-box">
                <div class="col-lg-7 col-md-12 form-info">
                    <div class="form-section">
                        <div class="logo clearfix">
                            <a href="login-8.html">
                                <!-- <img src="{{ asset('assets') }}/login-assets/img/logos/logo-2.png" alt="logo"> -->
                            </a>
                        </div>
                        <h3>Sign Into Your Account</h3>
                        <div class="login-inner-form">
                            <div class="form__icons error-text">
                                @if (session()->has('error'))
                                    {{ session('error') }}
                                @endif
                            </div>
                            <div class="form__icons text-logout">
                                @if (session()->has('logout'))
                                    {{ session('logout') }}
                                @endif
                            </div>
                            <form name="loginfrm" method="post" action="{{ route('admin.auth') }}">
                                @csrf
                                <div class="form-group form-box">
                                    <input type="text" name="username" id="username" class="form-control"
                                        placeholder="Username" aria-label="Username">
                                    <i class="flaticon-mail-2"></i>
                                </div>
                                <div class="form-group form-box">
                                    <input type="password" name="password" id="password" class="form-control"
                                        autocomplete="off" placeholder="Password" aria-label="Password">
                                    <i class="flaticon-password"></i>
                                </div>
                                <!-- <div class="checkbox form-group form-box">
                                <div class="form-check checkbox-theme">
                                    <input class="form-check-input" type="checkbox" value="" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">Remember me</label>
                                </div>
                                <a href="forgot-password-8.html">Forgot Password</a>
                            </div> -->
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn-md btn-theme w-100"
                                        style="background-color: #2a2d8c;">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 bg-img">
                    <div class="info">
                        <div class="info-text">
                            <div class="waviy">
                                <span style="--i:1; color: #fbca1a;">L</span>
                                <span style="--i:2; color: #fbca1a;">O</span>
                                <span style="--i:3; color: #fbca1a;">G</span>
                                <span style="--i:4; color: #fbca1a;">I</span>
                                <span style="--i:5; color: #fbca1a;">N</span>
                                <span style="--i:6">t</span>
                                <span style="--i:7">o</span>
                                <span style="--i:8; color: #fbca1a;">V</span>
                                <span style="--i:9; color: #fbca1a;">M</span>
                                <span style="--i:10; color: #fbca1a;">H</span>
                                <span style="--i:11; color: #fbca1a;">G</span>
                                <span style="--i:12; color: #fbca1a;">R</span>
                                <span style="--i:13; color: #fbca1a;">O</span>
                                <span style="--i:14; color: #fbca1a;">U</span>
                                <span style="--i:15; color: #fbca1a;">P</span>
                                <span style="--i:16; color: #fbca1a;"></span>
                            </div>
                            <p style="text-align: center; font-size: 15px;">Your login information is securely saved on our website. At VMH GROUP, we use advanced encryption and multi-factor authentication to ensure your data remains protected. Thank you for trusting us with your information.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets') }}/login-assets/js/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets') }}/login-assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets') }}/login-assets/js/jquery.validate.min.js"></script>

</body>

</html>