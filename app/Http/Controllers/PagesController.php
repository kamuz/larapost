<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Mail;

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

    public function email(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' => $request->input('message'),
        ];

        Mail::to('v.kamuz@gmail.com')->send(new ContactMessage($data));

        return redirect('/contact')->with('success', 'Your message has been sent!');
    }
}
