<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class CallbackController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function callback(Request $request)
    {
        $request_data = $request->getContent();
        $obj_request = json_decode($request_data);
        $trans_id = $obj_request->data->trans_id;
        /*
        $obj_request->data->cp_trans_id
        $obj_request->data->msisdn
        $obj_request->data->shortcode
        $obj_request->data->service_id
        $obj_request->data->css_keyword
        $obj_request->data->cp_id
        */
        $statusCode=200;
        $jsonRes = new \stdClass();
        $jsonRes->code = $statusCode;
        $jsonRes->description = "Success";
        $jsonRes->trans_id =$trans_id;
        $content = json_encode($jsonRes);
        return (new Response($content, $statusCode))
        ->header('Content-Type', 'Application/json');
    }
    //
}
