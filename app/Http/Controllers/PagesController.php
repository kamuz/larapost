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

    public function contact(){
        return view('pages.contact');
    }

    public function email(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        // return dd($data);

        $message = '<p>From Name: ' . $request['name'] . '</p>';
        $message .= '<p>From Email: ' . $request['email'] . '</p>';
        $message .= '<p>Message: </p>' . $request['message'];

        mail('v.kamuz@gmail.com', 'Message from my site', $message);

        return redirect('/contact')->with('success', 'Your message has been sent!');
    }
}
