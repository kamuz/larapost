<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = "Welcome to Laravel Application";
        return view('pages.index', compact('title'));
    }

    public function about(){
        return view('pages.about');
    }

    public function services(){
        $data = array(
            'title' => 'Our services',
            'services' => ['Web Desing', 'HTML Coding', 'WordPress Theme Development', 'WordPress Plugin Development']
        );
        return view('pages.services')->with($data);
    }
}
