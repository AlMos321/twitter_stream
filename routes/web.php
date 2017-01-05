<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $tweetsTrack = \App\Http\Controllers\Feeds\TwitterController::$trackArray;
    if (Auth::check()) {
        $tweets = App\Tweet::orderBy('created_at', 'desc')->paginate(5);
    } else {
        $tweets = App\Tweet::where('approved', 1)->orderBy('created_at', 'desc')->take(25)->get();
    }

    return view('welcome', ['tweets' => $tweets, 'tweetsTrack' => $tweetsTrack]);
});

Route::get('/get-last-tweets', function (Illuminate\Http\Request $request) {
    $tweets = App\Tweet::where('approved', 1)->orderBy('created_at', 'desc')->take(25)->get();
    if (isset($tweets[0]->id) && $tweets[0]->id != $request->last_id) {
        return response()->json(['tweets' => $tweets]);
    } else {
        return response()->json(['tweets' => [], 'emptyData' => 1]);
    }
});


Route::post('approve-tweets', [
    'middleware' => 'auth',
    function (Illuminate\Http\Request $request) {
        $tweets = App\Tweet::all();
        foreach ($tweets as $tweet) {
            $tweet->approved = 1;
            $tweet->save();
        }
        return redirect()->back();
    }
]);

/*
 * Approved tweet by id
 */
Route::post('approve-tweet', [
    'middleware' => 'auth',
    function (Illuminate\Http\Request $request) {
        if ($request->ajax() == false) {
            return response()->json(['status' => 'error. Not ajax request']);
        } else {
            $tweetId = $request->id;
            $tweet = App\Tweet::find($tweetId);
            if ($tweet) {
                $tweet->approved = 1;
                $tweet->save();
            }
            return response()->json(['status' => 'success']);
        }
    }
]);

/*
 * Unapproved tweet by id
 */
Route::post('unapprove-tweet', [
    'middleware' => 'auth',
    function (Illuminate\Http\Request $request) {
        if ($request->ajax() == false) {
            return response()->json(['status' => 'error. Not ajax request']);
        } else {
            $tweetId = $request->id;
            $tweet = App\Tweet::find($tweetId);
            if ($tweet) {
                $tweet->approved = 0;
                $tweet->save();
            }
            return response()->json(['status' => 'success']);
        }
    }
]);


Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/twitter-settings', 'Feeds\TwitterController@index');

Route::get('/start', 'Feeds\TwitterController@start');


