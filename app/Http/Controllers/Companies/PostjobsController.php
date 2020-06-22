<?php

namespace App\Http\Controllers\Companies;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PostjobsController extends Controller
{
    public function get()
    {
    	return view('front/companies.postjob');
    }

    public static function post()
    {
        print_r("post");
    }

    
}
