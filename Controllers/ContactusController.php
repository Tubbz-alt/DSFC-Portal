<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use Session;
use DB;

class ContactusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view('dashboards.contact');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request)
    {
        $userdetails    = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'user_message' => $request->get('message')
        ];

            $mail = Mail::send('dashboards.contact-message',$userdetails, function($message) use ($userdetails) {  //it wont return anything coz its void

            $message->to('najum.khan@iboxdashboards.com')->subject($userdetails['user_message']);
            $message->sender('no-reply@DSfC.com', 'DSfC');


        });

        Session::flash('success', 'Your message has been sent successfully. Thank You for contacting us!');
        return redirect('/dashboard/contact-us')->with('message', '');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postStoreFeedback(Request $request)
    {
        $data = $request->all();

        $userdetails    = [
            'subject' => $request->get('subject'),
            'description' => $request->get('description'),
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'url' => $request->get('url'),
            'title' => $request->get('title'),
        ];

        DB::table('emfeedback')->insert($userdetails);

            $mail = Mail::send('dashboards.feedback-message',$userdetails, function($message) use ($userdetails) {  //it wont return anything coz its void

            $message->to('najum.khan@iboxdashboards.com')->subject($userdetails['subject']);
            $message->sender('no-reply@DSfC.com', 'DSfC');


        });



        Session::flash('success', 'Thank You for your Feedback !');
        return redirect('/dashboard')->with('message', '');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
