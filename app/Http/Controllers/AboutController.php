<?php namespace GenomeX\Http\Controllers;

use GenomeX\Http\Requests;
use GenomeX\Http\Controllers\Controller;
use GenomeX\Http\Requests\ContactFormRequest;

use Illuminate\Http\Request;

class AboutController extends Controller {

	public function index()
	{
		return view('about.index');
	}

	public function create()
	{
	   return view('about.contact');
	}

    public function store(ContactFormRequest $request)
    {

        \Mail::send('emails.contact',
            array(
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'user_message' => $request->get('message')
            ), function($message)
        {
            $message->from(env('EMAIL_FROM'));
            $message->to(env('EMAIL_FROM'), env('MAIL_NAME'));
            $message->subject('GenomeX Feedback');

        });

      return \Redirect::route('contact')
        ->with('message', 'Thanks for contacting us!');

    }

}
