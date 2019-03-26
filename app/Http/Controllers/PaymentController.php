<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use YandexCheckout\Client;

class PaymentController extends Controller
{

    public function show()
    {

//        $ch = curl_init();
//
//        curl_setopt($ch, CURLOPT_URL, 'https://edge.qiwi.com/person-profile/v1/profile/current?authInfoEnabled=true');
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
//
//
//        $headers = array();
//        $headers[] = 'Accept: application/json';
//        $headers[] = 'Content-Type: application/json';
//        $headers[] = 'Authorization: Bearer e93726ccc457d1a9b76c8c414d6b564a';
//        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//
//        $result = curl_exec($ch);
//
//        dd(json_decode($result,true));
//        if (curl_errno($ch)) {
//            echo 'Error:' . curl_error($ch);
//        }
//        curl_close ($ch);



        return view('payments.index');
    }
}
