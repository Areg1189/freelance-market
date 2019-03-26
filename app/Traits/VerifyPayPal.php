<?php
/**
 * Created by PhpStorm.
 * User: Maximum Code
 * Date: 08.02.2019
 * Time: 15:22
 */

namespace App\Traits;


use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Service\AdaptiveAccountsService;
use PayPal\Types\AA\AccountIdentifierType;
use PayPal\Types\AA\GetVerifiedStatusRequest;

trait VerifyPayPal
{

    public static function getApiContext()
    {
//        $clientId = 'AUKZ2GkwZV2xrbe9qTTtUzxpam6t7XC0ChH08ULCQerVFt82QiMEJm5MA7BbJO-8y7vZxaqABAGKWYwy';
//        $clientSecret = 'ENimQWFClA37C3_eVUP5hvNZT6-ImkIyEFvvMLh1e7k9OMc8wL9f6DbCjNq3lRCRLB2RbNFocxTETinl';
//        $clientId = 'AW6int4xUQUSPHxfLrKTJ1slaznxG4Fxd4CiKPdERkiETkfF-R-mMhlQ6KCXlKUArBCwsqs3CABCuCEK';
//        $clientSecret = 'EIQNjcsqqvuP-Nw2Sk6jo3hC2aO7w2Zze_RXk8r_G54k-i8234CZPTnjZ39WZYMXYhKtM8ZFm3Df7FZE';
        $clientId = 'AazLEsLlqn1jk_kOkbe5w-MBsqURXFt_c-WdBmISZibj5g-i2ENi08gC9soPlxw00ehfmV5297kmC_v9';  //live - gev
        $clientSecret = 'EPXSjPYKrt5a79FETY6L4a7nJI7VCZDIfMskn6VqOExixEtleE-uWVQGE7apUbhwsCzADA3tJh5vAuC7';

//        $clientId = 'AV_ilqwsnQ1GBPfLUNo8w_NShHvBNIQ1UfeyHYUyD3Tu-nXQXRdOW3r_zEpAal__v4XM_-5CLqImg9t5';  //live - tt454
//        $clientSecret = 'EKhODCRim1KtnTSzRxREIJZ0XrZEuLCQarl2ux9X6q47hVzJC1wxBqzn-lZHjS4AqgbyAE5MlYyEf7cm';
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                $clientId,
                $clientSecret
            )
        );

        $apiContext->setConfig(
            array(
                'mode' => 'live',
                'log.LogEnabled' => true,
                'log.FileName' => '../PayPal.log',
                'log.LogLevel' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
                'cache.enabled' => true,
                'notify_merchant' => true,
                'send_to_merchant' => true,
                'notify_customer' => true,
                'send_to_customer' => true,
                // 'cache.FileName' => '/PaypalCache' // for determining paypal cache directory
                // 'http.CURLOPT_CONNECTTIMEOUT' => 30
                // 'http.headers.PayPal-Partner-Attribution-Id' => '123123123'
                // 'log.AdapterFactory' => '\PayPal\Log\DefaultLogFactory' // Factory class implementing \PayPal\Log\PayPalLogFactory
            )
        );
        return $apiContext;
    }

    public static function getConfig()
    {
        $config = array(
            // values: 'sandbox' for testing
            //		   'live' for production
            "mode" => "sandbox",
            'log.LogEnabled' => true,
            'log.FileName' => '../PayPal.log',
            'log.LogLevel' => 'FINE'
            // These values are defaulted in SDK. If you want to override default values, uncomment it and add your value.
            // "http.ConnectionTimeOut" => "5000",
            // "http.Retry" => "2",

        );
        return $config;
    }


    public static function getAcctAndConfig()
    {
        $config = array(
            // Signature Credential
            "acct1.UserName" => "tt4540631-facilitator_api1.gmail.com",
            "acct1.Password" => "V24W8EDW9LPMZTBY",
            "acct1.Signature" => "Aa3zhgdKERtB4tcA.kTvAagxGiJIAjG92cUw0lNzut58JeSMO6GDX9MM",
            "acct1.AppId" => "APP-80W284485P519543T",

            // Sample Certificate Credential
            // "acct1.UserName" => "certuser_biz_api1.paypal.com",
            // "acct1.Password" => "D6JNKKULHN3G5B8A",
            // Certificate path relative to config folder or absolute path in file system
            // "acct1.CertPath" => "cert_key.pem",
            // "acct1.AppId" => "APP-80W284485P519543T"
            // Sandbox Email Address
            "service.SandboxEmailAddress" => "gevorg.gal@gmail.com"
        );

        return array_merge($config, self::getConfig());
    }

    public function verify_Paypal_Address($email, $match_criteria)
    {

        $getVerifiedStatus = new GetVerifiedStatusRequest();
        $accountIdentifier = new AccountIdentifierType();

        $accountIdentifier->emailAddress = $email;
        $getVerifiedStatus->accountIdentifier = $accountIdentifier;

        // when  $match_criteria == "NAME"
        // $getVerifiedStatus->firstName = 'Hayro';
        // $getVerifiedStatus->lastName = 'Tokhunts';
        $getVerifiedStatus->matchCriteria = $match_criteria;
        $service = new AdaptiveAccountsService(self::getAcctAndConfig());

        try {
            $response = $service->GetVerifiedStatus($getVerifiedStatus);
            return $ack = strtoupper($response->responseEnvelope->ack);
        } catch (\Exception $ex) {

            return $ack = 'error';
        }

    }
}