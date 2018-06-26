<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
    * load notifications
    *
    *
    */
    public function notifications()
    {
        return auth()->user()->notifications()->take(10)->get()->toArray();
    }

    /**
    * read a specific notification
    *
    * @param $id
    * @return mixed
    */
    public function read($id)
    {
    	$user = Auth::user();
    	$notification = $user->notifications()->where('id', $id)->first();

    	if ($notification)
    	{
    		$notification->markAsRead();
    	}

    	return redirect($notification->data['action']);
    }

    /**
    * delete a specific notification
    *
    * @param $id
    * @return mixed
    */
    public function delete($id)
    {

    }
}
