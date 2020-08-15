<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
    	$title='Welcome to Paris';
    	return view('pages.index')->with('title',$title);
    }
     public function about()
    {
    	$title='About Us';
    	return view('pages.about')->with('title',$title);
    }
     public function services()
    {
    	$data = array(
    		'title' =>'Services',
    		'services'=>array('Dev','SEO','Programming')
    	);
    	return view('pages.services')->with($data);
    }

    public function username(request $data)
    {
        return $data = \App\User::where('username',$data->username)->count();
    }
}
