@include('partials/header')

<div class="container">
    <div id="SubmitModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="Mtitle"></h4>
                </div>
                <div class="modal-body">
                    <form>

                        <div class="form-group">
                            <label for="email">MRP:</label>
                            <span id="mrp"></span>
                        </div>
                        <div class="form-group">
                            <label for="email">Price:</label>
                            <input type="text" class="form-control" id="disc">
                        </div>

                        <div class="form-group">
                            <label for="email">Quantity:</label>
                            <input type='button' value='-' class='qtyminus' field='quantity' onclick="decPr()"/>
                            <input type='number' name='quantity' value='1' class='qty' min="1" id="quantity"/>
                            <input type='button' value='+' class='qtyplus' field='quantity' onclick="incrPr()"/>

                        </div>
                        {{--<div class="form-group">--}}
                            {{--<label for="email">Coupon:</label>--}}
                            {{--<div class="input-group">--}}
                                {{--<input type="text" class="form-control" id="coupon">--}}
                                {{--<span class="input-group-btn">--}}
                                  {{--<button class="btn btn-default" type="button" onclick="couponBut()">Apply!</button>--}}
                                 {{--</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}


                        <div class="form-group">
                            <label for="email">Total:</label>
                            <span id="total"></span>

                        </div>

                        <input type="hidden" class="form-control" id="uid" value="">
                        <input type="hidden" class="form-control" id="lid" value="">
                        <input type="hidden" class="form-control" id="vpid" value="">
                        <input type="hidden" class="form-control" id="phoneid" value="">
                        <input type="hidden" class="form-control" id="ecom" value="">

                        <a class="btn btn-success " onclick="submitUpdate()">Update</a>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <img src="{{$image}}" onerror="this.src='../../images/Default_Book_Thumbnail.png'" width="50%"
                 class="img-polaroid" alt="Lenovo Desktop">
        </div>
        <div class="col-md-8">
            <h2>{{$name}}</h2>
            <br>
            <h4 class="muted">Author : {{$brand_name}}</h4>
            <h4 class="muted">Publisher : {{$manufacturer}}</h4>
            <hr>
            <br>
            <p class="comment">{{$description}}</p>
            <hr>
            {{--<h3>Price - <del class="text-error">$699</del> $499</h3>--}}
            <h3>Price - &#8377; {{$price}}</h3>
            <p class="muted">Inclusive of all taxes. </p>
            <br>
            @if($avail == true)

                <p><a href="#" class="btn btn-success btn-large modalTog" data-toggle="modal" data-storeid="{{$id}}"
                      data-product="{{$productId}}" data-mrp="{{$mrp}}" data-discount="{{$price}}"
                      data-Prname="{{$name}}"
                      data-phoneid="{{$phoneid}}" data-vpid="{{$vPid}}" data-ecomm="{{$ecomm}}">Buy</a></p>

            @else

                <p>No Stock Available</p>
            @endif
        </div>
    </div>
</div>

<div class="new-collections">
    <div class="container">
        <h3 class="animated wow zoomIn" data-wow-delay=".5s">Similar Items</h3>

        <div class="SlickSimilarclass col-md-12">


            @foreach($similar as $item)

                <div class=" animated wow slideInUp" data-wow-delay=".5s">
                    <div class="bookCards col-xs-6 col-sm-2 col-md-12 col-lg-10 ">
                        <div class="item item_shadow">
                            <div class="img_block_books"><a rel="external" data-ajax="false"
                                                            href="/{{ $item['name'] }}/product_details/{{$item['product_id']}}"><img
                                            style="height: 160px;margin-left: -7%" src="{{ $item['image'] }}"
                                            width="100%"
                                            onerror="this.src='../../images/Default_Book_Thumbnail.png'"></a></div>
                            <div class="carousel_body_book">
                                <div class="carousel_title_book"><h5
                                            title="{{ $item['name'] }}">{{ $item['name'] }}</h5></div>
                                <del class="text-error carousel_title_book_p_del"
                                     style="font-size: 82%; margin-left: 9%;color: darkgrey;">MRP -
                                    &#8377; {{ $item['price'] }}</del>
                                <p class="carousel_title_book_p">&#8377; {{ $item['discount'] }}</p>
                                <div class="carousel_desc"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>


    </div>
</div>


<script type="text/javascript" src="{!! asset('js/shorten.js') !!}"></script>
<script>
    $(document).ready(function () {


        $(".comment").shorten({
            "showChars": 300,
            "moreText": "Read More",
            "lessText": "Less",
        });


        $(".modalTog").click(function () {
            $("h4#Mtitle").text($(this).data('prname'));
            $("#mrp").text($(this).data('mrp'));
            $("#disc").val($(this).data('discount'));
            $("#total").text($(this).data('discount'));
            $("#uid").val($(this).data('product'));
            $("#lid").val($(this).data('storeid'));
            $("#vpid").val($(this).data('vpid'));
            $("#phoneid").val($(this).data('phoneid'));
            $("#ecom").val($(this).data('ecomm'));
            $('#SubmitModal').modal('show');


        });

    });


    function submitUpdate() {

        var name = $("h4#Mtitle").text();
        var mrp = $("#mrp").text();
        var disc = parseInt($("#total").text());
        var productID = $("#uid").val();
        var locId = $("#lid").val();
        var vpid = $("#vpid").val();
        var phoneid = $("#phoneid").val();
        var ecomm = $("#ecom").val();
//        var email = $("#email").val();
//        var phone = $("#contact").val();
        var count = $("#quantity").val();
//        if (email === "") {
//            alert("Please enter an email address");
//            return false;
//        }
//        if (phone === "") {
//            alert("Please enter a phone number");
//            return false;
//        }
        var image="{{$image}}";

        $(".spinner").show();

        $.ajax({
            type: 'GET',
            url: '/submitProduct?pid=' + vpid + "&pname=" + name + "&image=" + image + "&mrp=" + mrp + "&price=" + disc + "&locId=" + locId + "&ecom=" + ecomm +
            "&phoneid=" + phoneid+"&count="+count,
            success: function (data) {
                $(".spinner").hide();
                alert("Successfullly added to card")


            },
            error: function (err) {
                console.log(err.responseText);
            }
        });


    }


    function couponBut() {

        $(".spinner").show()
        var coupon = $("#coupon").val();


        $.ajax({
            type: 'GET',
            url: '/couponSubmit?coupon=' + coupon,
            success: function (data) {
                $(".spinner").hide();
                alert(data)


            },
            error: function (err) {
                console.log(err.responseText);
            }
        });

    }


    jQuery(document).ready(function () {
        // This button will increment the value
        $('.qtyplus').click(function (e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).attr('field');
            // Get its current value
            var currentVal = parseInt($('input[name=' + fieldName + ']').val());
            // If is not undefined
            if (!isNaN(currentVal)) {
                // Increment
                $('input[name=' + fieldName + ']').val(currentVal + 1);
            } else {
                // Otherwise put a 0 there
                $('input[name=' + fieldName + ']').val(0);
            }
        });
        // This button will decrement the value till 0
        $(".qtyminus").click(function (e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).attr('field');
            // Get its current value
            var currentVal = parseInt($('input[name=' + fieldName + ']').val());
            // If it isn't undefined or its greater than 0
            if (!isNaN(currentVal) && currentVal > 0) {
                // Decrement one
                $('input[name=' + fieldName + ']').val(currentVal - 1);
            } else {
                // Otherwise put a 0 there
                $('input[name=' + fieldName + ']').val(0);
            }
        });
    });


    function incrPr() {

        $("#total").text(parseInt($("#disc").val()) * (parseInt($("#quantity").val())+1))
    }


    function decPr() {

        $("#total").text(parseInt($("#disc").val()) * (parseInt($("#quantity").val())-1))

    }
</script>
