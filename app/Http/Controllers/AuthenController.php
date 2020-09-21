<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
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
        echo "Request:".$request_data."<br/>";
        $obj_request = json_decode($request_data);

        $cp_trans_id = date('YmdHis').rand(100,999);

        //$endpoint = "https://aoc.truecorp.co.th/authen";
        $endpoint = "https://aoc-stg.truecorp.co.th/authen"; // stg

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $endpoint, [
            'grant_type' => 'client_credentials',
            'client_id' => $obj_request->client_id,
            'client_secret' => $obj_request->client_secret,            
            'cp_trans_id' => $obj_request->cp_trans_id           
        ]);
        $response = Http::post($endpoint, $postdata);        
        // url will be: http://my.domain.com/test.php?key1=5&key2=ABC;
        
        $statusCode = $response->getStatusCode();
        $content = $response->getBody();
        

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$postdata);
        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close ($ch);
        // Further processing ...
        if ($server_output != "") 
        { 
            $resObj = json_decode($server_output);  
            $jsonRes->access_token = $resObj->access_token;
            $jsonRes->cp_trans_id = $data_obj->cp_trans_id;
            $jsonRes->service_id = $data_obj->service_id;
            $jsonRes->css_keyword = $data_obj->css_keyword;
            $jsonRes->cp_id = $data_obj->cp_id;
            echo json_encode($jsonRes);
            } 
        else 
        { 
            echo "Fail";
        }


        echo "access_token:".$obj_request->access_token."<br/>";
        echo "cp_trans_id:".$obj_request->cp_trans_id."<br/>";
        echo "service_id:".$obj_request->service_id."<br/>";
        echo "cpAuthen";
    }
    //
}
