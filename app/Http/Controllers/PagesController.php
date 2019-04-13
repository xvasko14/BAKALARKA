<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
    	return view('pages.index');
    }

    public function league(){
    	return view('league.about');
    }
    
    public function Gallery(){
    	return view('pages.gallery');
    }
}
