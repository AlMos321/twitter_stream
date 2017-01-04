<?php

namespace App\Http\Controllers\Feeds;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class TwitterController extends Controller
{

    public static $trackArray = [
        'Стражи Галактики. Часть 2',
        'стражи галактики 2',
        'Guardians of the Galaxy Vol. 2',
        'Guardians',
        '#Gamora',
        '#Drax'
    ];

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
     * todo settings for tweets search
     * @return mixed
     */
    public function index()
    {
        return view('settings');
    }

    public function start()
    {
        call_in_background('connect_to_streaming_api');
        return redirect()->back();
    }
    
}
