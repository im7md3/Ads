<?php

namespace App\Http\Controllers\admin;

use App\Ad;
use App\Category;
use App\Comment;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function dashboard(){
        $number_of_ads=Ad::count();
        $number_of_categories=Category::count();
        $number_of_users=User::count();
        $number_of_comments=Comment::count();
        return view('admin.index',compact(['number_of_ads','number_of_categories','number_of_users','number_of_comments']));
    }
}
