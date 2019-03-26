<?php
/**
 * Created by PhpStorm.
 * User: Maximum Code
 * Date: 22.02.2019
 * Time: 11:26
 */

namespace App\Services;

use App\Traits\VerifyPayPal;
use PayPal\Api\Address;
use PayPal\Api\BillingInfo;
use PayPal\Api\CancelNotification;
use PayPal\Api\Currency;
use PayPal\Api\Invoice;
use PayPal\Api\InvoiceAddress;
use PayPal\Api\InvoiceItem;
use PayPal\Api\MerchantInfo;
use PayPal\Api\Notification;
use PayPal\Api\PaymentTerm;
use PayPal\Api\Phone;
use PayPal\Api\Tax;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PayPal
{
    public function getApiContext()
    {
//        $clientId = 'AUKZ2GkwZV2xrbe9qTTtUzxpam6t7XC0ChH08ULCQerVFt82QiMEJm5MA7BbJO-8y7vZxaqABAGKWYwy';  //sand - gev - gevorg.gal@gmail.com
//        $clientSecret = 'ENimQWFClA37C3_eVUP5hvNZT6-ImkIyEFvvMLh1e7k9OMc8wL9f6DbCjNq3lRCRLB2RbNFocxTETinl';

        $clientId = 'AW6int4xUQUSPHxfLrKTJ1slaznxG4Fxd4CiKPdERkiETkfF-R-mMhlQ6KCXlKUArBCwsqs3CABCuCEK';   //sand - tt454 --tt4540631-facilitator@gmail.com
        $clientSecret = 'EIQNjcsqqvuP-Nw2Sk6jo3hC2aO7w2Zze_RXk8r_G54k-i8234CZPTnjZ39WZYMXYhKtM8ZFm3Df7FZE';

//        $clientId = 'AazLEsLlqn1jk_kOkbe5w-MBsqURXFt_c-WdBmISZibj5g-i2ENi08gC9soPlxw00ehfmV5297kmC_v9';  //live - gev -- gladiator.arto@gmail.com
//        $clientSecret = 'EPXSjPYKrt5a79FETY6L4a7nJI7VCZDIfMskn6VqOExixEtleE-uWVQGE7apUbhwsCzADA3tJh5vAuC7';

//        $clientId = 'AV_ilqwsnQ1GBPfLUNo8w_NShHvBNIQ1UfeyHYUyD3Tu-nXQXRdOW3r_zEpAal__v4XM_-5CLqImg9t5';  //live - tt454  --tt4540631@gmail.com
//        $clientSecret = 'EKhODCRim1KtnTSzRxREIJZ0XrZEuLCQarl2ux9X6q47hVzJC1wxBqzn-lZHjS4AqgbyAE5MlYyEf7cm';



        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                $clientId,
                $clientSecret
            )
        );

        $apiContext->setConfig(
            array(
                'mode' => 'sandbox',
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
    public function createAndSendInvoice($job, $amount)
    {
        $apiContext = $this->getApiContext();

//        $payer_email = "xazaryan.89@mail.ru";

        $employer = $job->user->employer;

        $invoice = new Invoice();

        $invoice->setMerchantInfo(new MerchantInfo())
            ->setBillingInfo(array(new BillingInfo()))
            ->setNote("Freelance Invoice". date("Y-m-d").".")
            ->setPaymentTerm(new PaymentTerm());

        //## MERCHANT info
        $invoice->getMerchantInfo()
            ->setEmail(setting('site.merchant_email'))   //this is a project owner paypal address
            ->setFirstName(setting('site.merchant_first_name'))
            ->setLastName(setting('site.merchant_last_name'))
            ->setbusinessName(setting('site.merchant_business_name'))
            ->setPhone(new Phone())
            ->setAddress(new Address());

        $invoice->getMerchantInfo()->getPhone()
            ->setCountryCode(setting('site.merchant_phone_code'))
            ->setNationalNumber(setting('site.merchant_phone_number'));

        $invoice->getMerchantInfo()->getAddress()
            ->setLine1(setting('site.merchant_address_line'))
            ->setCity(setting('site.merchant_city'))
            ->setState(setting('site.merchant_state'))
            ->setPostalCode(setting('site.merchant_country_postal_code'))
            ->setCountryCode(setting('site.merchant_country_code'));
        //## BILLING info
        $billing = $invoice->getBillingInfo();
        $billing[0]->setEmail($employer->payer_email);     //this a employer paypal address   $payer_email

        $billing[0]->setAdditionalInfo("This is the billing Info")
            ->setAddress(new InvoiceAddress());

        $billing[0]->getAddress()
            ->setLine1($employer->address)
            ->setCity(getCities($employer->city_id)->name)
            ->setState(getState($employer->state_id)->name)
            ->setPostalCode($employer->postal_code)
            ->setCountryCode(getCountries($employer->country_id)->code);

        // ### Items List
        $items = array();
        $items[0] = new InvoiceItem();
        $items[0]->setName($job->title)
            ->setQuantity(1)
            ->setUnitPrice(new Currency());

        $items[0]->getUnitPrice()
            ->setCurrency("USD")
            ->setValue($amount);

        // #### Tax Item
        $tax = new Tax();
        $tax->setPercent(1)->setName("Local Tax on $job->title");
        $items[0]->setTax($tax);

        $invoice->setItems($items);
        $invoice->getPaymentTerm()
            ->setTermType("NET_45");

        // ### Logo
//        $invoice->setLogoUrl(asset('storage/'.setting('site.logo')));

        // ### Create Invoice
        $request = clone $invoice;

        try {
            $invoice->create($apiContext);

        } catch (\Exception $ex) {

            return  $invoice = ['success'=>false,'message'=>'Invalid request - see details.(create) !'];

        }

        //## SEND invoice
        try {
            // ### Send Invoice
            $sendStatus = $invoice->send($apiContext);
        } catch (\Exception $ex) {
            return  $invoice = ['success'=>false,'message'=>'Invalid request - see details.(send) !'];

        }

        // ### Retrieve Invoice
        try {
            $invoice = Invoice::get($invoice->getId(), $apiContext);

        } catch (\Exception $ex) {
            return  $invoice = ['success'=>false,'message'=>'Invalid request - see details.(save) !'];
        }

        return $invoice = ['success'=>true,'message'=>'Thank you - Invoice send!', 'invoice'=>$invoice];

    }
    public function notification($invoice)
    {
        try {
            $notify = new Notification();
            $notify->setSubject("Past due")
                ->setNote("Please pay soon")
                ->setSendToMerchant(true);

            $remindStatus = $invoice->remind($notify, self::getApiContext());

        } catch (\Exception $ex) {
            dd($ex);
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
            \ResultPrinter::printError("Remind Invoice", "Invoice", null, $notify, $ex);
            exit(1);
        }
        return $remindStatus;
    }

    public function getQR($invoice){
        try {
            $image = Invoice::qrCode($invoice->getId(), array('height' => '300', 'width' => '300'), self::getApiContext());

            $path = $image->saveToFile("images/sample.png");
        } catch (\Exception $ex) {
            \ResultPrinter::printError("Retrieved QR Code for Invoice", "Invoice", $invoice->getId(), null, $ex);
            exit(1);
        }

        echo '<img src="data:image/png;base64,' . $image->getImage() . '" alt="Invoice QR Code" />';
    }

    public function cancelInvoice($id, $user){

        $invoice = \App\Models\Invoice::find($id);
        $invoice_id = $invoice->invoice_id;

        $invoice = Invoice::get($invoice_id, self::getApiContext());

        try {
            $notify = new CancelNotification();
            $notify
                ->setSubject("Past due")
                ->setNote("Canceling invoice")
                ->setSendToMerchant(true)
                ->setSendToPayer(true);
            $cancelStatus = $invoice->cancel($notify, self::getApiContext());
        } catch (\Exception $ex) {
            return $invoice = ['success'=>false,'message'=>'Invalid request - see details.(delete)!'];
            exit(1);
        }

        return  $invoice = ['success'=>true,'message'=>'Your Invoice Canceled!'];

    }

}