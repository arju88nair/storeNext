<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!--[if lt IE 7]>
    <html class="no-js ie6 oldie" lang="en"> <![endif]-->
    <!--[if IE 7]>
    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
    <!--[if IE 8]>
    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
    <!--[if IE 9]>
    <html class="no-js ie9 oldie" lang="en"> <![endif]-->
    <meta charset="utf-8">
    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description"
          content="Coming soon, Bootstrap, Bootstrap 3.0, Free Coming Soon, free coming soon, free template, coming soon template, Html template, html template, html5, Code lab, codelab, codelab coming soon template, bootstrap coming soon template">
    <title>StoreNxt</title>
    <!-- ============ Google fonts ============ -->
    <link href='http://fonts.googleapis.com/css?family=EB+Garamond' rel='stylesheet'
          type='text/css'/>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300,800'
          rel='stylesheet' type='text/css'/>
    <!-- ============ Add custom CSS here ============ -->
    <link href="{!! asset('css/bootstrap.min.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('css/style.css') !!}" rel="stylesheet" type="text/css"/>

    <link href="{!! asset('css/font-awesome.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('css/form-elements.css') !!}" rel="stylesheet" type="text/css"/>

</head>
<body>
<div class="top-content">

    <div class="inner-bg">
        <div class="container">

            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">
                    <h1><strong>StoreNxt</strong> Login &amp; Register Forms</h1>
                    <div class="description">
                        @if(Session::has('message'))
                            <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message') }}</p>
                        @endif
                        {{--<p>--}}
                        {{--This is a free responsive <strong>"login and register forms"</strong> template made with Bootstrap.--}}
                        {{--Download it on <a href="http://azmind.com" target="_blank"><strong>AZMIND</strong></a>,--}}
                        {{--customize and use it as you like!--}}
                        {{--</p>--}}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="text-center" style="display:flex;
 justify-content:center;
 align-items: center;
 flex-flow: column;">
                <div class="col-sm-5" id="loginBox">

                    <div class="form-box">
                        <div class="form-top">
                            <div class="form-top-left">
                                <h3>Login to our site</h3>
                                <p>Enter email and password to log on:</p>
                            </div>
                            <div class="form-top-right">
                                <i class="fa fa-lock"></i>
                            </div>
                        </div>
                        <div class="form-bottom">
                            <form role="form" action="/login" method="post" class="login-form">
                                <div class="form-group">
                                    <label class="sr-only" for="form-username">Email</label>
                                    <input required type="text" name="email" placeholder="Username..."
                                           class="form-username form-control" id="form-username">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="form-password">Password</label>
                                    <input required type="password" name="password" placeholder="Password..."
                                           class="form-password form-control" id="form-password">
                                </div>
                                <button type="submit" class="btn">Sign in!</button>
                            </form>
                        </div>


                        <br>
                        <div class="text-center"><button onclick="registerOption()" class="btn">Or Register Now!</button></div>
                    </div>

                    {{--<div class="social-login">--}}
                    {{--<h3>...or login with:</h3>--}}
                    {{--<div class="social-login-buttons">--}}
                    {{--<a class="btn btn-link-2" href="#">--}}
                    {{--<i class="fa fa-facebook"></i> Facebook--}}
                    {{--</a>--}}
                    {{--<a class="btn btn-link-2" href="#">--}}
                    {{--<i class="fa fa-twitter"></i> Twitter--}}
                    {{--</a>--}}
                    {{--<a class="btn btn-link-2" href="#">--}}
                    {{--<i class="fa fa-google-plus"></i> Google Plus--}}
                    {{--</a>--}}
                    {{--</div>--}}
                    {{--</div>--}}

                </div>
                </div>

            </div>
            <div class="row">
                <div class="text-center" style="display:flex;
 justify-content:center;
 align-items: center;
 flex-flow: column;">
                    <div class="col-sm-5 regDiv" style="display:none;">

                        <div class="form-box">
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3>Sign up now</h3>
                                    <p>Fill in the form below to get instant access:</p>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-pencil"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                                <form role="form" action="/formRegister" method="post" class="registration-form">
                                    <div class="form-group">
                                        <label class="sr-only" for="form-first-name">Store Name</label>
                                        <input required type="text" name="inputStoreName" placeholder="Store name..."
                                               class="form-first-name form-control" id="form-first-name">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-email">Email</label>
                                        <input required type="text" name="inputEmail" placeholder="Email..."
                                               class="form-email form-control" id="form-email">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-last-name">Password</label>
                                        <input required type="password" name="inputPassword" placeholder="Password ..."
                                               class="form-last-name form-control" id="form-passwprd">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-last-name">Phone</label>
                                        <input required type="text" name="inputPhn" placeholder="Phone number ..."
                                               class="form-last-name form-control" id="form-phone">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-last-name">Address</label>
                                        <input required type="text" name="inputAddress" placeholder="Address ..."
                                               class="form-last-name form-control" id="form-address">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-last-name">Landmark</label>
                                        <input required type="text" name="inputLandmark" placeholder="Landmark ..."
                                               class="form-last-name form-control" id="form-landmark">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-last-name">City</label>
                                        <input required type="text" name="inputCity" placeholder="City ..."
                                               class="form-last-name form-control" id="form-city">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-last-name">State</label>
                                        <input required type="text" name="inputState" placeholder="State ..."
                                               class="form-last-name form-control" id="form-state">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-last-name">Pincode</label>
                                        <input required type="number" name="inputPin" placeholder="Pincode ..."
                                               class="form-last-name form-control" id="form-pin" maxlength="6" minlength="0">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-last-name">Referred by (Optional)</label>
                                        <input required type="text" name="inputref" placeholder="Referred by(Optional) ..."
                                               class="form-last-name form-control" id="form-last-name">
                                    </div>

                                    <button type="submit" class="btn">Sign me up!</button>
                                </form>
                            </div>
<br>
                            <div class="text-center"><button onclick="loginOption()" class="btn">Or Log In!</button></div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

</div>

<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">


        </div>
    </div>
</footer>

<script src="{!! asset('js/jquery.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/bootstrap.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/jquery.backstretch.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/scripts.js') !!}" type="text/javascript"></script>
<script type="text/javascript">
function registerOption()
{
    $("#loginBox").hide()
    $(".regDiv").fadeIn()
}
function loginOption()
{
    $(".regDiv").hide()

    $("#loginBox").fadeIn()
}
</script>

</body>
</html>
