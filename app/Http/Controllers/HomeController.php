<?php

namespace App\Http\Controllers;
use App\Models\Home;
use View;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    //


    public function index(Request $request)
    {
        return Home::index($request->all);
    }


    public function adminView(Request $request)
    {
        return Home::adminView($request->all);
    }



    public function formRegister(Request $request)
    {
        return Home::formRegister($request->all);
    }


    public function getUserDetails(Request $request)
    {
        return Home::getUserDetails($request->all);
    }


    public function updateUser(Request $request)
    {
        return Home::updateUser($request->all);
    }


    public function login(Request $request)
    {
        return Home::login($request->all);
    }


    public function home(Request $request)
    {
        return Home::home($request->all);
    }


    public function details(Request $request)
    {
        return Home::details($request->all);
    }

    public function submitProduct(Request $request)
    {
        return Home::submitProduct($request->all);
    }


    public function couponSubmit(Request $request)
    {
        return Home::couponSubmit($request->all);
    }

    public function logout(Request $request)
    {
        return Home::logout($request->all);
    }


    public function loadmore(Request $request)
    {
        return Home::loadmore($request->all);
    }



    public function search(Request $request)
    {
        return Home::search($request->all);
    }


    public function getProfile(Request $request)
    {
        return Home::getProfile($request->all);
    }


    public function updateProfile(Request $request)
    {
        return Home::updateProfile($request->all);
    }


    public function checkout(Request $request)
    {
        return Home::checkout($request->all);
    }
}