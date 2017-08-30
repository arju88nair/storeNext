<!DOCTYPE html>
<html>
<head>
    <title>StoreNxt</title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="StoreNxt Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
    Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design"/>
    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);
        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>
    <!-- //for-mobile-apps -->
    <link href="{!! asset('css/bootstrap.min.css') !!}" rel="stylesheet" type="text/css" media="all"/>
    <link href="{!! asset('css/style2.css') !!}" rel="stylesheet" type="text/css" media="all"/>
    <!-- js -->
    <script src="{!! asset('js/jquery.js') !!}"></script>
    <!-- //js -->
    <!-- cart -->
    <script src="{!! asset('js/simpleCart.min.js') !!}"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.7.1/slick.min.js"></script>

    <!-- cart -->
    <!-- for bootstrap working -->
    <script type="text/javascript" src="{!! asset('js/bootstrap.min.js') !!}"></script>
    <!-- //for bootstrap working -->
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic'
          rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic'
          rel='stylesheet' type='text/css'>
    <!-- timer -->
    <link rel="stylesheet" href="{!! asset('css/jquery.countdown.css') !!}"/>

    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.7.1/slick.css"/>
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.7.1/slick-theme.css"/>
    <!-- //timer -->
    <!-- animation-effect -->
    <link href="{!! asset('css/animate.min.css') !!}" rel="stylesheet">
    <script src="{!! asset('js/wow.min.js') !!}"></script>
    <script>
        new WOW().init();
        $(document).ready(function () {
            $('#reportModal').on('shown.bs.modal', function (e) {
                document.getElementById('iframeId').contentDocument.location.reload(true);
            })


            $('.Slickclass').slick({
                infinite: true,
                speed: 300,
                slidesToShow: 5,
                slidesToScroll: 5,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                ]
            });
            $('.SlickSimilarclass').slick({
                infinite: true,
                speed: 300,
                slidesToShow: 5,
                slidesToScroll: 5,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                ]
            });
        });


        function searchTerm() {
            var term = $("#searchIn").val()

            window.location.href = "/search?q=" + term
        }


        function profileModal() {
            $.ajax({
                type: 'GET',
                url: '/getProfile',
                success: function (data) {
                    $(".spinner").hide();
                    console.log(data)
                    if (data === 0 || data === "0") {
                        alert("Something went wrong! Please try again.")
                    }
                    else {
                        $("#inputStoreName").val(data[0]['location_name'])
                        $("#inputAddress").val(data[0]['address'])
                        $("#inputCity").val(data[0]['city'])
                        $("#inputEmail").val(data[0]['email'])
                        $("#inputPassword").val(data[0]['password'])
                        $("#inputPhn").val(data[0]['mobile_number'])
                        $("#inputLandmark").val(data[0]['landmark'])
                        $("#inputState").val(data[0]['state']);
                        $("#inputPin").val(data[0]['pincode']);
                        $('#profileModal').modal('show');


                    }


                },
                error: function (err) {
                    console.log(err.responseText);
                }
            });
        }



        function updateProfile()
        {
            $(".spinner").show()
            $.ajax({
                type: 'GET',
                url: '/updateProfile?name='+$("#inputStoreName").val()+"&email="+$("#inputEmail").val()+"&city="+$("#inputCity").val()+"&address="+$("#inputAddress").val()
                +"&password="+$("#inputPassword").val()+"&phone="+$("#inputPhn").val()+"&landmark="+$("#inputLandmark").val()+"&state="+$("#inputState").val()+"&pincode="+$("#inputPin").val(),
                success: function (data) {
                    $(".spinner").hide();
                    if (data === "success") {
                        alert("Successfully updated")
                    }
                    else {
                        alert("Something went wrong.Please try again.")
                    }


                },
                error: function (err) {
                    console.log(err.responseText);
                }
            });
        }

    </script>
    <!-- //animation-effect -->
</head>
<body>
<!-- header -->
<div class="header">
    <div class="container">
        <div class="spinner" style='display: none'>
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
        {{--<div class="header-grid">--}}
        {{--<div class="header-grid-left animated wow slideInLeft" data-wow-delay=".5s">--}}
        {{--<ul>--}}
        {{--<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:info@example.com">@example.com</a></li>--}}
        {{--<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>+1234 567 892</li>--}}


        {{--@if(Session::has('message'))--}}
        {{--@else--}}
        {{--<li><i class="glyphicon glyphicon-log-out" aria-hidden="true"></i><a href="/logout">Logout</a></li>--}}
        {{--@endif--}}

        {{--</ul>--}}
        {{--</div>--}}
        {{--<div class="header-grid-right animated wow slideInRight" data-wow-delay=".5s">--}}

        {{--<ul class="social-icons">--}}
        {{--<li><i class="glyphicon glyphicon-log-in" aria-hidden="true"></i><a href="/register">Logout</a></li>--}}

        {{--<li><a href="#" class="facebook"></a></li>--}}
        {{--<li><a href="#" class="twitter"></a></li>--}}
        {{--<li><a href="#" class="g"></a></li>--}}
        {{--<li><a href="#" class="instagram"></a></li>--}}
        {{--</ul>--}}
        {{--</div>--}}
        {{--<div class="clearfix"> </div>--}}
        {{--</div>--}}
        <div class="logo-nav">
            <div class="logo-nav-left animated wow zoomIn" data-wow-delay=".5s">
                <h1><a href="/">StoreNxt <br><span>Shop anywhere</span></a></h1>
            </div>
            <div class="logo-nav-left1">
                <nav class="navbar navbar-default">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header nav_2">
                        <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse"
                                data-target="#bs-megadropdown-tabs">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="index.html" class="act">Home</a></li>
                            <li><a href="#"  onclick="profileModal()"> Profile</a></li>
                            <li><a href="#"  data-toggle="modal" data-target="#reportModal">Reports</a></li>
                            <li><a href="#/logout"  >Logout</a></li>

                        </ul>
                    </div>

                    <div class="col-md-5 animated wow zoomIn" style="margin-top: 4%" data-wow-delay=".5s">
                        <div class="input-group" id="adv-search">
                            <input type="text" class="form-control" id="searchIn" placeholder="Search for items"/>
                            <div class="input-group-btn">
                                <div class="btn-group" role="group">
                                    {{--<div class="dropdown dropdown-lg">--}}
                                    {{--<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>--}}
                                    {{--<div class="dropdown-menu dropdown-menu-right" role="menu">--}}
                                    {{--<form class="form-horizontal" role="form">--}}
                                    {{--<div class="form-group">--}}
                                    {{--<label for="filter">Filter by</label>--}}
                                    {{--<select class="form-control">--}}
                                    {{--<option value="0" selected>All Category</option>--}}
                                    {{--<option value="1">Featured</option>--}}
                                    {{--<option value="2">Most popular</option>--}}
                                    {{--<option value="3">Top rated</option>--}}
                                    {{--<option value="4">Most commented</option>--}}
                                    {{--</select>--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group">--}}
                                    {{--<label for="contain">Author</label>--}}
                                    {{--<input class="form-control" type="text" />--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group">--}}
                                    {{--<label for="contain">Contains the words</label>--}}
                                    {{--<input class="form-control" type="text" />--}}
                                    {{--</div>--}}
                                    {{--<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>--}}
                                    {{--</form>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    <button type="button" class="btn btn-primary btn-custom" onclick="searchTerm()">
                                        <span class="glyphicon glyphicon-search" aria-hidden="true"
                                              onclick="searchTerm()"></span></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </nav>
            </div>
            <div class="logo-nav-right">


            </div>
            <div class="header-right animated wow zoomIn" data-wow-delay=".5s">
                <div class="cart box_1">
                    <a href="/checkout">
                        <h3> <div class="total">
                                <span class="simpleCart_total"></span> (<span id="simpleCart_quantity" class="simpleCart_quantity"></span> items)</div>
                            <img src="images/bag.png" alt="" />
                        </h3>
                    </a>
                    <div class="clearfix"> </div>
                </div>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
</div>


<div id="profileModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Your Profile</h4>
            </div>
            <div class="modal-body">
                <div class="form-bottom">
                    <form role="form" action="/formRegister" method="post" class="registration-form">
                        <div class="form-group">
                            <label class="sr-only" for="form-first-name">Store Name</label>
                            <input required type="text" id="inputStoreName" placeholder="Store name..."
                                   class="form-first-name form-control" id="form-first-name">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="form-email">Email</label>
                            <input required type="text" id="inputEmail" placeholder="Email..."
                                   class="form-email form-control" id="form-email">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="form-last-name">Password</label>
                            <input required type="password" id="inputPassword" placeholder="Password ..."
                                   class="form-last-name form-control" id="form-passwprd">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="form-last-name">Phone</label>
                            <input required type="text" id="inputPhn" placeholder="Phone number ..."
                                   class="form-last-name form-control" id="form-phone">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="form-last-name">Address</label>
                            <input required type="text" id="inputAddress" placeholder="Address ..."
                                   class="form-last-name form-control" id="form-address">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="form-last-name">Landmark</label>
                            <input required type="text" id="inputLandmark" placeholder="Landmark ..."
                                   class="form-last-name form-control" id="form-landmark">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="form-last-name">City</label>
                            <input required type="text" id="inputCity" placeholder="City ..."
                                   class="form-last-name form-control" id="form-city">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="form-last-name">State</label>
                            <input required type="text" id="inputState" placeholder="State ..."
                                   class="form-last-name form-control" id="form-state">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="form-last-name">Pincode</label>
                            <input required type="number" id="inputPin" placeholder="Pincode ..."
                                   class="form-last-name form-control" id="form-pin" maxlength="6" minlength="0">
                        </div>


                        <button type="button" class="btn" onclick="updateProfile()">Update</button>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>

</div>


<div id="reportModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Reports</h4>
            </div>
            <div class="modal-body">
                <iframe src="http://srv1.brandclub.mobi/es/store/orderlistWeb.php?storeid={{$id}}" width="100%" height="380" frameborder="0"
                        allowtransparency="true" id="iframeId"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>

</div>


