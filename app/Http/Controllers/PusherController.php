<?php

namespace App\Http\Controllers;

use Pusher\Pusher;
use Illuminate\Http\Request;

class PusherController extends Controller
{
    public function sendNotification()
    {
        //Remember to change this with your cluster name.
        $options = array(
            'cluster' => 'ap1', 
            'encrypted' => true
        );
 
       //Remember to set your credentials below.
        $pusher = new Pusher(
            '07ad24f2076c53b4b7bc',
            '470ea7cd790bb4acd6f3',
            '531273',
            $options
        );
        
        $message= "Hello User";
        
        //Send a message to notify channel with an event name of notify-event
        $pusher->trigger('notify', 'notify-event', $message);  
    }
}
