<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use YandexMoney\API;

class YandexController extends Controller
{

    public function test(){
        return view('yandex.test');
    }

    public function getAccessToken(){
        $client_secret = '41E73991E076C1B0F4D275E1E9FA7F869937E13820EDE0753090C9EEA9E543D772CAB9C77C84FA3A17A2BEEA251058E2504A5B212CBB73BAD7E916C5CE2A0834';
        $access_token_response = API::getAccessToken($client_id=NULL, $code=NULL, $redirect_uri=NULL, $client_secret=NULL);
        if(property_exists($access_token_response, "error")) {
            // process error
        }
        $access_token = $access_token_response->access_token;

        return $access_token;
    }

    public function createInvoice(){
        $master_token = 'AEgchkX2M3FBL8lU';
        $operation_num = 119;
        $used_method = 'CreateInvoice';
        $login = 'agrom';
        $finance_token = hash("sha256", $master_token . $operation_num . $used_method . $login);
    }


}
