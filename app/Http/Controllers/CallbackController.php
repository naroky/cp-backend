<?php

namespace App\Http\Controllers;
class CallbackController extends Controller
use Illuminate\Http\Request;
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function callback(Request $request)
    {
        echo "callback";
    }
    //
}
