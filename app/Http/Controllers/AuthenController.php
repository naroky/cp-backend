<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
class AuthenController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function cpAuthen(Request $request)
    {
        $request_data = $request->getContent();
        $obj_request = json_decode($request_data);

        $cp_trans_id = date('YmdHis').rand(100,999);
        //$endpoint = "https://aoc.truecorp.co.th/authen";
        $endpoint = "https://aoc-stg.truecorp.co.th/authen"; // stg

        $client = new \GuzzleHttp\Client(['verify' => false ]);
        $response = $client->request('POST', $endpoint, ['form_params' =>[
            'grant_type' => 'client_credentials',
            'client_id' => $obj_request->client_id,
            'client_secret' => $obj_request->client_secret,            
            'cp_trans_id' => $cp_trans_id           
        ]]);       
        $statusCode = $response->getStatusCode();
        $content = $response->getBody();
        $resObj = json_decode($content); 
        $jsonRes = new \stdClass();
        $jsonRes->access_token = $resObj->access_token;
        $jsonRes->cp_trans_id = $cp_trans_id;
        $jsonRes->service_id = $obj_request->service_id;
        $jsonRes->css_keyword = $obj_request->css_keyword;
        $jsonRes->cp_id = $obj_request->client_id;
        $content = json_encode($jsonRes);
        return (new Response($content, $statusCode))
        ->header('Content-Type', 'Application/json');
    }
    //
}
