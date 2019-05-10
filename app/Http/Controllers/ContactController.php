<?php

namespace App\Http\Controllers;
use App\Http\Requests\ContactFormRequest;
use Illuminate\Http\Request;

use App\Mail\ContactEmail;
use App\Http\Requests;

class ContactController extends Controller {

    public function create()
    {
        return view('pages.create');
    }

    public function store(Request $request)
    {
        $contact = [];

        $contact['name'] = $request->get('name');
        Mail::to(config('mail.support.address'))->send(new ContactEmail($contact));
        $contact['msg'] = $request->get('msg');

        // Mail delivery logic goes here

        flash('Your message has been sent!')->success();

        return redirect()->route('pages.create');
    }

}
