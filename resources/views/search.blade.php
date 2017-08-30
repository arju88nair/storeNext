<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
@include('partials/header')





{{--<div class="search-box">--}}
{{--<div id="sb-search" class="sb-search">--}}
{{--<form>--}}
{{--<input class="sb-search-input" placeholder="Enter your search term..." type="search" id="search">--}}
{{--<input class="sb-search-submit" type="submit" value="">--}}
{{--<span class="sb-icon-search"> </span>--}}
{{--</form>--}}
{{--</div>--}}
{{--</div>--}}
{{--<!-- search-scripts -->--}}
{{--<script src="{!! asset('js/classie.js') !!}"></script>--}}
{{--<script src="{!! asset('js/uisearch.js') !!}"></script>--}}
{{--<script>--}}
{{--new UISearch( document.getElementById( 'sb-search' ) );--}}
{{--</script>--}}
<!-- //search-scripts -->

<!-- //header -->
<!-- banner -->
{{--<div class="banner">--}}
{{--<div class="container">--}}
{{--<div class="banner-info animated wow zoomIn" data-wow-delay=".5s">--}}
{{--<h3>Free Online Shopping</h3>--}}
{{--<h4>Up to <span>50% <i>Off/-</i></span></h4>--}}
{{--<div class="wmuSlider example1">--}}
{{--<div class="wmuSliderWrapper">--}}
{{--<article style="position: absolute; width: 100%; opacity: 0;">--}}
{{--<div class="banner-wrap">--}}
{{--<div class="banner-info1">--}}
{{--<p>T-Shirts + Formal Pants + Jewellery + Cosmetics</p>--}}
{{--</div>--}}
{{--</div>--}}
{{--</article>--}}
{{--<article style="position: absolute; width: 100%; opacity: 0;">--}}
{{--<div class="banner-wrap">--}}
{{--<div class="banner-info1">--}}
{{--<p>Toys + Furniture + Lighting + Watches</p>--}}
{{--</div>--}}
{{--</div>--}}
{{--</article>--}}
{{--<article style="position: absolute; width: 100%; opacity: 0;">--}}
{{--<div class="banner-wrap">--}}
{{--<div class="banner-info1">--}}
{{--<p>Tops + Books & Media + Sports</p>--}}
{{--</div>--}}
{{--</div>--}}
{{--</article>--}}
{{--</div>--}}
{{--</div>--}}
{{--<script src="{!! asset('js/jquery.wmuSlider.js') !!}"></script>--}}
{{--<script>--}}
{{--$('.example1').wmuSlider();--}}
{{--</script>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
<!-- //banner -->

<!-- banner-bottom -->
<!-- //banner-bottom -->
<!-- collections -->
<div class="new-collections">
    <div class="container">
        <h4 class="animated wow zoomIn" data-wow-delay=".5s">Search results for the query : "{{$term}}"</h4>
        <div class="new-collections-grids">
            <div class="col-md-12 new-collections-grid" style="margin-left: 4%" id="trendingDiv">

                @foreach($normal as $item)

                    <div class=" animated wow slideInUp" data-wow-delay=".5s" style="background-color: white">
                        <div class="bookCards col-xs-6 col-sm-2 col-md-2 col-lg-2 "><div class="item item_shadow"><div class="img_block_books"><a rel="external" data-ajax="false" href="/{{ $item['name'] }}/product_details/{{ $item['product_id'] }}"><img style="height: 160px;margin-left: -7%" src="{{ $item['image'] }}" width="100%" onerror="this.src='../../images/Default_Book_Thumbnail.png'"></a></div><div class="carousel_body_book"><div class="carousel_title_book"><h5 title="{{ $item['name'] }}">{{ $item['name'] }}</h5></div> <del class="text-error carousel_title_book_p_del" style="font-size: 82%; margin-left: 9%;color: darkgrey;">MRP - &#8377; {{ $item['price'] }}</del><p class="carousel_title_book_p">&#8377; {{ $item['discount'] }}</p><div class="carousel_desc"></div></div></div></div>
                    </div>



                @endforeach




            </div>
            <div class="text-center"><button type="button" class="btn btn-default" onclick="loadMore()" id="load">Load More</button></div>

        </div>
    </div>
</div>
<!-- //collections -->
<!-- new-timer -->

<!-- //new-timer -->
<!-- collections-bottom -->
<!-- //collections-bottom -->
<!-- footer -->
<div class="footer">
    <div class="container">
        <div class="footer-grids">
            <div class="col-md-6 footer-grid animated wow slideInLeft" data-wow-delay=".5s">
                <h3>About Us</h3>
                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse.<span>Excepteur sint occaecat cupidatat
						non proident, sunt in culpa qui officia deserunt mollit.</span></p>
            </div>
            <div class="col-md-6 footer-grid animated wow slideInLeft" data-wow-delay=".6s">
                <h3>Contact Info</h3>
                <ul>
                    <li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>1234k Avenue, 4th block, <span>New York City.</span></li>
                    <li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:info@example.com">info@example.com</a></li>
                    <li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>+1234 567 567</li>
                </ul>
            </div>

            <div class="clearfix"> </div>
        </div>
        <div class="footer-logo animated wow slideInUp" data-wow-delay=".5s">
            <h2><a href="index.html">StoreNxt <span>shop anywhere</span></a></h2>
        </div>
        <div class="copy-right animated wow slideInUp" data-wow-delay=".5s">
            <p>&copy 2016 StoreNxt. All rights reserved </p>
        </div>
    </div>
</div>
<!-- //footer -->

<script>

    $(document).ready(function()
    {        localStorage.clear()

        localStorage.setItem("countFlag",2)
    })
    function loadMore()
    {
        $(".spinner").show();

        var count = localStorage.getItem("countFlag");
        localStorage.setItem("countFlag", parseInt(count) + 1);

        $.ajax({
            type: 'GET',
            url: '/loadmore?count=' + count ,
            success: function (data) {
                $(".spinner").hide();
                if(data === "No Titles")
                {
                    alert("No more result to show !");
                    return false;
                }
                for(var i=0; i<data.length;i++)
                {

                    $("#trendingDiv").append('<div class=" animated wow slideInUp" data-wow-delay=".5s" style="background-color: white">' +
                        '<div class="bookCards col-xs-6 col-sm-2 col-md-2 col-lg-2 "><div class="item item_shadow"><div class="img_block_books"><a rel="external" data-ajax="false" href="/'+data[i]['name']+'/product_details/'+data[i]['product_id']+'"><img style="height: 160px;margin-left: -7%" src="'+data[i]['image']+'" width="100%" onerror="this.src=\'../../images/Default_Book_Thumbnail.png\'"></a></div><div class="carousel_body_book"><div class="carousel_title_book"><h5 title="'+data[i]['name']+'">'+data[i]['name']+'</h5></div> <del class="text-error carousel_title_book_p_del" style="font-size: 82%; margin-left: 9%;color: darkgrey;">MRP - &#8377; '+data[i]['price']+'</del><p class="carousel_title_book_p">&#8377; '+data[i]['discount']+'</p><div class="carousel_desc"></div></div></div></div></div>')
                }


            },
            error: function (err) {
                $(".spinner").hide();

                console.log(err.responseText);
            }
        });



    }



</script>
</body>
</html>