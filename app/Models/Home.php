<?php
/**
 * Created by PhpStorm.
 * User: nair
 * Date: 21/8/17
 * Time: 5:11 PM
 */

namespace App\Models;

use DB;
use Illuminate\Support\Facades\Mail;
use Redirect;
use View;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Route;

define('API_URL', 'http://srv1.brandclub.mobi:8082/');
session_start();

class Home extends Model
{


    public static function curlFunctionEs($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, API_URL . $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);            // No header in the result
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return, do not echo result
        $raw_data = curl_exec($ch);
        curl_close($ch);
        return $raw_data;
    }

    public static function post_curl($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, API_URL . $url);
        curl_setopt($ch, CURLOPT_POST, 1);
//        curl_setopt($ch, CURLOPT_POSTFIELDS,
//            "count=1&categories=2");

// in real life you should use something like:
// curl_setopt($ch, CURLOPT_POSTFIELDS,
//          http_build_query(array('postvar1' => 'value1')));

// receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close($ch);
        return $server_output;
    }


    public static function normalCurlPost($post, $url)
    {
        // set post fields


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, API_URL . $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

// execute!
        $response = curl_exec($ch);

// close the connection, release resources used
        curl_close($ch);
        return $response;
    }


    public static function index($request)
    {
        session_destroy();



//        if (!isset($_SESSION['id'])) {
//            return Redirect::to('/');
//
//        }

        return View::make('welcome');
    }


    public static function formRegister($request)
    {


        $userResult = DB::table('location_details')->where('email', '=', '' . $_POST['inputEmail'] . '')->get();
        if ($userResult == [] || count($userResult) == 0) {


            $result = DB::table('location_details')->insert(
                ['location_name' => $_POST['inputStoreName'], 'mobile_number' => $_POST['inputPhn'], 'password' => $_POST['inputPassword'], 'email' => $_POST['inputEmail'], 'address' => $_POST['inputAddress'], 'landmark' => $_POST['inputLandmark'], 'city' => $_POST['inputCity'], 'state' => $_POST['inputState'], 'pincode' => $_POST['inputPin'], 'lat' => "12.7285", 'lng' => "77", 'app_version' => 1, 'method' => 'signup', 'is_authenticated' => 0]
            );

            if ($result) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                curl_setopt($ch, CURLOPT_USERPWD, 'api:key-1-j3498psszetjazh3-e1o5c6qgn60v4');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                curl_setopt($ch, CURLOPT_URL,
                    'https://api.mailgun.net/v3/mail.freenet.zone/messages');
                curl_setopt($ch, CURLOPT_POSTFIELDS,
                    array('from' => 'auto-confirmation@freenet.zone <auto-confirmation@freenet.zone>',
                        'to' => 'avinashkumar.k@freenet.zone',
                        'subject' => 'arju88nair@gmail.com',
                        'html' => View::make('emails.send', [
                            'title' => '' . $_POST['inputStoreName'] . '',
                            'email' => '' . $_POST['inputEmail'] . '',
                            'phone' => '' . $_POST['inputPhn'] . '',
                            'address' => '' . $_POST['inputAddress'] . "," . $_POST['inputLandmark'] . "," . $_POST['inputCity'] . "," . $_POST['inputState'] . "," . $_POST['inputPin'] . ''
                        ])));
                $result1 = curl_exec($ch);
                //echo json_encode($result1);
//            curl_close($ch);

                return Redirect::to('/register')->with('message', 'successfully registered.');
            } else
                return Redirect::to('/register')->with('message', 'Please try again');

        } else {
            return Redirect::to('/register')->with('message', 'Email Already Exists');

        }
    }


    public static function adminView()
    {

        $query = "select * from  location_details order by id desc ";
        $response = DB::select($query);


        return View::make('adminview')->with('data', $response);

    }


    public static function getUserDetails()
    {
        $id = $_GET['id'];

        $query = "select * from  user_account_details where location_id=$id ";
        $response = DB::select($query);


        return $response;

    }

    public static function updateUser()
    {
        $id = $_GET['id'];
        $lid = $_GET['location_id'];
        $gst = $_GET['gst'];
        $vat = $_GET['vat'];
        $tin = $_GET['tin'];
        $status = $_GET['status'];

        if ($id == '') {
            $query = "REPLACE INTO user_account_details (gst, vat,tin,active,location_id) VALUES('$gst','$vat','$tin','$status',$lid)";

        } else {
            $query = "REPLACE INTO user_account_details (id, gst, vat,tin,active,location_id) VALUES('$id', '$gst','$vat','$tin','$status',$lid)";

        }

        $response = DB::statement($query);

        if ($response) {
            return "success";
        } else {
            return "failure";
        }

    }


    public static function login($request)
    {
        $email = $_POST['email'];
        $pasword = $_POST['password'];

        $response = DB::table('location_details')->where('email', '=', '' . $email . '')->where('password', '=', '' . $pasword . '')->first();
        if (empty($response)) {
            return Redirect::to('/register')->with('message', 'Wrong credentials.Please try again');

        } else {
            $_SESSION['id'] = $response->id;
            return Redirect::to('/')->with('message', 'Wrong credentials.Please try again');

        }


    }


    public static function home($request)
    {

        if (!isset($_SESSION['id'])) {
            $flag = 0;

            return Redirect::to('/register')->with('message', 'Please login again');

        }
        $flag = 1;
        $result = self::post_curl("sn/getHomePage/");
        $result = json_decode($result, True);
        $data = $result;
        $Dealarray = [];
        foreach ($data['deals'] as $item) {
            $small = [];
            $small['name'] = $item['hits']['hits'][0]['_source']['product_name'];
            $small['product_id'] = $item['hits']['hits'][0]['_source']['product_id'];
            $small['price'] = $item['hits']['hits'][0]['_source']['spec']['price'];
            $small['image'] = $item['hits']['hits'][0]['_source']['spec']['image'];
            $small['discount'] = (int)$item['hits']['hits'][0]['_source']['spec']['price'] - (((int)$item['hits']['hits'][0]['_source']['spec']['price'] / 100) * 15);
            array_push($Dealarray, $small);


        }
        $array = [];
        foreach ($data['trending']['hits']['hits'] as $trend) {
            $smallArr = [];
            $smallArr['name'] = $trend['_source']['product_name'];
            $smallArr['product_id'] = $trend['_source']['product_id'];
            if (isset($trend['_source']['spec']['price'])) {
                $smallArr['price'] = $trend['_source']['spec']['price'];
                $smallArr['discount'] = (int)$trend['_source']['spec']['price'] - (((int)$trend['_source']['spec']['price'] / 100) * 15);


            } else {
                $smallArr['price'] = "N/A";
                $smallArr['discount'] = "N/A";
            }


            if (isset($trend['_source']['spec']['image'])) {
                $smallArr['image'] = $trend['_source']['spec']['image'];

            } else {
                $smallArr['image'] = "../../images/Default_Book_Thumbnail.png";
            }

            array_push($array, $smallArr);


        }

        $sesId=$_SESSION['id'];

        return View::make('Home')->with('deals', $Dealarray)->with('normal', $array)->with('id',$sesId);


    }


    public static function details($request)

    {
        if (!isset($_SESSION['id'])) {
            return Redirect::to('/register')->with('message', 'Please login again');

        }
        $parametrs = request()->route()->parameters;
        $id = $parametrs['id'];

        $post = [
            'product_id' => $id
        ];
        $url = "sn/getProductByIdNew/";
        $response = self::normalCurlPost($post, $url);
        $data = json_decode($response, True);
        $varpost = [

            'search_id' => $data['hits']['hits'][0]['_id']

        ];




        $varUrl = "sn/getProductFromVendor/";
        $varianRes = self::normalCurlPost($varpost, $varUrl);
        $varianRes = json_decode($varianRes, True);
        $id = $_SESSION['id'];


        $simPsot = [
            "params" => "{\"category_id\":2,\"sub_category\":-1,\"avg_price\":195,\"product_id\":2147483647,\"type\":\"similar\",\"filter\":{\"brand_name\":[\"R.L. Stine\"],\"manufacturer\":[\"Scholastic Incorporated\"]}}"
        ];
        $simUrl = "sn/getFilterSimilar/";
        $simResponse = self::normalCurlPost($simPsot, $simUrl);
        $simData = json_decode($simResponse, True);
        $array = [];
        foreach ($simData['hits']['hits'] as $trend) {
            $smallArr = [];
            $smallArr['name'] = $trend['_source']['product_name'];
            $smallArr['product_id'] = $trend['_source']['product_id'];
            if (isset($trend['_source']['spec']['price'])) {
                $smallArr['price'] = $trend['_source']['spec']['price'];
                $smallArr['discount'] = (int)$trend['_source']['spec']['price'] - (((int)$trend['_source']['spec']['price'] / 100) * 15);


            } else {
                $smallArr['price'] = "N/A";
                $smallArr['discount'] = "N/A";
            }


            if (isset($trend['_source']['spec']['image'])) {
                $smallArr['image'] = $trend['_source']['spec']['image'];

            } else {
                $smallArr['image'] = "../../images/Default_Book_Thumbnail.png";
            }

            array_push($array, $smallArr);


        }
        $discount = round((int)$data['hits']['hits'][0]['_source']['spec']['price'] - (((int)$data['hits']['hits'][0]['_source']['spec']['price'] / 100) * 15));
        $sesId=$_SESSION['id'];
        if(count($varianRes) ==0)
        {

            return View::make('product_details')->with('name', $data['hits']['hits'][0]['_source']['product_name'])->with('productId', $data['hits']['hits'][0]['_source']['product_id'])->with('brand_name', $data['hits']['hits'][0]['_source']['brand_name'])->with('manufacturer', $data['hits']['hits'][0]['_source']['manufacturer'])->with('description', $data['hits']['hits'][0]['_source']['spec']['description'])->with('price', $discount)->with('available', $data['hits']['hits'][0]['_source']['is_available'])->with('avg_price', $data['hits']['hits'][0]['_source']['avg_price'])->with('image', $data['hits']['hits'][0]['_source']['spec']['image'])->with('id', $id)->with('mrp', $data['hits']['hits'][0]['_source']['spec']['price'])->with('phoneid', $data['hits']['hits'][0]['_id'])->with('similar', $array)->
            with('id',$sesId)->with('avail',false);
        }

        return View::make('product_details')->with('name', $data['hits']['hits'][0]['_source']['product_name'])->with('productId', $data['hits']['hits'][0]['_source']['product_id'])->with('brand_name', $data['hits']['hits'][0]['_source']['brand_name'])->with('manufacturer', $data['hits']['hits'][0]['_source']['manufacturer'])->with('description', $data['hits']['hits'][0]['_source']['spec']['description'])->with('price', $discount)->with('available', $data['hits']['hits'][0]['_source']['is_available'])->with('avg_price', $data['hits']['hits'][0]['_source']['avg_price'])->with('image', $data['hits']['hits'][0]['_source']['spec']['image'])->with('id', $id)->with('mrp', $data['hits']['hits'][0]['_source']['spec']['price'])->with('ecomm', $varianRes[0]['ecommerce'])->with('vPid', $varianRes[0]['productid'])->with('phoneid', $data['hits']['hits'][0]['_id'])->with('similar', $array)->
with('id',$sesId)->with('avail',true);
    }


    public static function submitProduct($request)
    {

//        store_id" -> "113"
//1 = {HashMap$HashMapEntry@5325} "ecomm" -> "Prakash"
//2 = {HashMap$HashMapEntry@5326} "payment" -> "cash"
//3 = {HashMap$HashMapEntry@5327} "mobile" -> "8880510982"
//4 = {HashMap$HashMapEntry@5328} "productid" -> "21319.0"
//5 = {HashMap$HashMapEntry@5329} "received_price" -> "166"
//6 = {HashMap$HashMapEntry@5330} "price" -> "195"
//7 = {HashMap$HashMapEntry@5331} "cust_state" -> "null"
//8 = {HashMap$HashMapEntry@5332} "cust_landmark" -> "null"
//9 = {HashMap$HashMapEntry@5333} "phone_id" -> "AV07ZzAQiU5Hr1E-htnX"
//10 = {HashMap$HashMapEntry@5334} "cust_address" -> "null"
//11 = {HashMap$HashMapEntry@5335} "cust_pin" -> "null"
//12 = {HashMap$HashMapEntry@5336} "cust_email" -> "s@jdk.hsk"
//13 = {HashMap$HashMapEntry@5337} "customer_name" -> "null"
//14 = {HashMap$HashMapEntry@5338} "cust_city" -> "null"
//15 = {HashMap$HashMapEntry@5339} "lat" -> "0.0"
//16 = {HashMap$HashMapEntry@5340} "long" -> "0.1"
//17 = {HashMap$HashMapEntry@5341} "delivery" -> "pickup"
//18 = {HashMap$HashMapEntry@5342} "product" -> "Invaders From Big Screen (Give Yourself Goosebumps - 29)"
//
//        $post = [
//            "store_id" => 1,
//            "ecomm" => $_GET['ecom'],
//            "payment" => "cash",
//            "mobile" => $_GET['phone'],
//            "productid" => $_GET['pid'],
//            "received_price" => $_GET['price'],
//            "price" => $_GET['mrp'],
//            "cust_state" => "null",
//            "cust_landmark" => "null",
//
//            "phone_id" => $_GET['phoneid'],
//            "cust_address" => "nul;",
//
//            "cust_pin" => "null",
//            "customer_name" => "null",
//
//            "product" => $_GET["pname"],
//            "long" => "0.0",
//
//            "cust_city" => "null",
//            "lat" => "0.1",
//
//            "cust_email" => $_GET['email'],
//            "delivery" => "pickup",
//            "count" => $_GET['count'],
//
//
//        ];
//        $url = "sn/shippingDetails/";
//        $response = self::normalCurlPost($post, $url);
//        return $response;


        $array=array();
        $array['title']=$_GET['pname'];
        $array['pid']=$_GET['pid'];
        $array['mrp']=$_GET['mrp'];
        $array['price']=$_GET['price'];
        $array['ecom']=$_GET['ecom'];
        $array['count']=$_GET['count'];
        $array['phoneid']=$_GET['phoneid'];
        $array['image']=$_GET['image'];
        array_push($_SESSION['cart'],$array);

        return "success";




    }


    public static function couponSubmit()
    {
        $coupon = $_GET['coupon'];
        return self::curlFunctionEs("sn/chkCoupon?coupon=$coupon");
    }

    public static function logout()
    {
        session_destroy();
        return Redirect::to('/register');
    }

    public static function loadmore()
    {
        $count=$_GET['count'];
        $post=[
            'count'=>$count,
            'categories'=>2


        ];

        $url = "sn/getHomePage/";
        $data = self::normalCurlPost($post, $url);
        $data= json_decode($data, True);
        $array = [];
        foreach ($data['trending']['hits']['hits'] as $trend) {
            $smallArr = [];
            $smallArr['name'] = $trend['_source']['product_name'];
            $smallArr['product_id'] = $trend['_source']['product_id'];
            if (isset($trend['_source']['spec']['price'])) {
                $smallArr['price'] = $trend['_source']['spec']['price'];
                $smallArr['discount'] = (int)$trend['_source']['spec']['price'] - (((int)$trend['_source']['spec']['price'] / 100) * 15);


            } else {
                $smallArr['price'] = "N/A";
                $smallArr['discount'] = "N/A";
            }


            if (isset($trend['_source']['spec']['image'])) {
                $smallArr['image'] = $trend['_source']['spec']['image'];

            } else {
                $smallArr['image'] = "../../images/Default_Book_Thumbnail.png";
            }

            array_push($array, $smallArr);



        }
        return $array;
    }


    public static function search()
    {
        $term=$_GET['q'];
        $post=[
            'product'=>$term


        ];

        $url = "sn/getProductByModel/";
        $data = self::normalCurlPost($post, $url);
        $data= json_decode($data, True);
        $array = [];
        foreach ($data['hits']['hits'] as $trend) {
            $smallArr = [];
            $smallArr['name'] = $trend['_source']['product_name'];
            $smallArr['product_id'] = $trend['_source']['product_id'];
            if (isset($trend['_source']['spec']['price'])) {
                $smallArr['price'] = $trend['_source']['spec']['price'];
                $smallArr['discount'] = (int)$trend['_source']['spec']['price'] - (((int)$trend['_source']['spec']['price'] / 100) * 15);


            } else {
                $smallArr['price'] = "N/A";
                $smallArr['discount'] = "N/A";
            }


            if (isset($trend['_source']['spec']['image'])) {
                $smallArr['image'] = $trend['_source']['spec']['image'];

            } else {
                $smallArr['image'] = "../../images/Default_Book_Thumbnail.png";
            }

            array_push($array, $smallArr);



        }
        return View::make('search')->with('normal', $array)->with('term',$term);

    }




    public static function getProfile($request)
    {
        $id=$_SESSION['id'];
        $query="select * from location_details where id=$id";
        $response=DB::select($query);
       if(!$response)
       {
           return 0;
       }

       return $response;
    }



    public static function updateProfile($request)
    {
        $name = $_GET['name'];
        $email = $_GET['email'];
        $address = $_GET['address'];
        $pin = $_GET['pincode'];
        $phone = $_GET['phone'];
        $password = $_GET['password'];
        $address = $_GET['address'];
        $landmark = $_GET['landmark'];
        $city = $_GET['city'];
        $state = $_GET['state'];
        $id=$_SESSION['id'];


        $query="update location_details set location_name = '$name', email ='$email', password = '$password', mobile_number = '$phone', address= '$address',
        landmark= '$landmark', city ='$city', state ='$state', pincode= '$pin' where id =$id
        
        ";
        $response=DB::statement($query);
        if($response)
        {
            return "success";
        }
        return false;



    }



    public static function checkout()
    {
        $items=$_SESSION['cart'];
        return $items;
    }
}


