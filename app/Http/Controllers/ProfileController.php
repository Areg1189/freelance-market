<?php

namespace App\Http\Controllers;

use App\Http\Requests\FreelancerRequest;
use App\Http\Requests\PayPalVerified;
use App\Models\Country;
use App\Models\Employer;
use App\Models\Freelancer;
use App\Models\FreelancerJob;
use App\Models\Job;
use App\Models\User;
use App\Models\Portfolio;
use App\Repositories\ImageCropRepository;
use App\Repositories\ProfileRepository;
use App\Traits\UploadeAvatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PayPal\Api\CancelNotification;
use PayPal\Api\Invoice;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class ProfileController extends Controller
{

    use  UploadeAvatar;
    protected $repo;

    public function __construct(ProfileRepository $repository)
    {
        $this->repo = $repository;
    }
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

//        $clientId = 'ATuVdT13HfW20uH4WWVoXGdITI5v6CYrhdRA73bnLF3Pld8HpkT47GvD_EWPBecgTBoTYcMej-GN7PiR';     //webhook send box tt454
//        $clientSecret = 'EKF-VW3vy6YN7h6roo6nJxYLd_CpXvfZXiIbRCMTGh0TfSoOug6nWvrhXwwqXxfJc0QsboIIWIo1yxYr';


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
    public function show()
    {
//        $invoice = Invoice::get('INV2-DZHX-UVHP-A9L2-BZHG', $this->getApiContext());
//        $notify = new CancelNotification();
//        $notify->setSubject("Past due")
//            ->setNote("Canceling invoice")
//            ->setSendToMerchant(true)
//            ->setSendToPayer(true);
//        $invoice = $invoice->cancel($notify, $this->getApiContext());
//        $data = '';
//        dd($invoice);


        $user = Auth::user();
        if ($user->hasRole('freelancer')) {
            $profile = $user->freelancer;
            return view('profile.show', compact('profile'));
        } else {
            $profile = $user->employer;
        }
        return view('profile.show', compact('profile'));
    }

    public function edit()
    {
        $user = auth()->user();
        if (auth()->user()->hasRole('freelancer')) {
            return $this->repo->editProfile($user);
        }
        return view('profile.edit', compact('user'));
    }

    public function updateFreelancer(FreelancerRequest $request)
    {
        $user = auth()->user();
        $this->repo->storeFreelancer($request, $user);

        return redirect()->route('profile');
    }

    public function updateEmployer(PayPalVerified $request)
    {
        $user = auth()->user();
        return $this->repo->storeEmployer($request, $user);
    }


    public function editPortfolio($id)
    {
        $portfolio = Portfolio::find($id);
        $view = view('include.edit-portfolio', compact('portfolio'))->render();

        return response()->json(['view' => $view]);
    }

    public function updatePortfolio(Request $request, $id)
    {
        $user = Auth::user();

        $this->repo->updatePortfolio($request, $id);

        $profile = $user->freelancer;

        $view = view('include.portfolio', compact('profile'))->render();
        return response()->json(['message' => "Your portfolio updated!", 'view' => $view]);
    }

    public function storePortfolio(Request $request)
    {
        $user = Auth::user();
        $this->repo->storePortfolio($request, $user);
        $profile = $user->freelancer;

        $view = view('include.portfolio', compact('profile'))->render();

        return response()->json(['message' => "Your portfolio created!", 'view' => $view]);
    }

    public function hidePortfolio($id)
    {
        $user = Auth::user();
        $portfolio = $this->repo->hidePortfolio($id);

        $show = $portfolio->show == 1 ? 'visible' : 'invisible';
        $profile = $user->freelancer;

        $view = view('include.portfolio', compact('profile'))->render();
        return response()->json(['message' => "Your portfolio is $show!", 'view' => $view]);
    }

    public function deletePortfolio($id)
    {
        $user = Auth::user();
        Portfolio::find($id)->delete();
        $profile = $user->freelancer;

        $view = view('include.portfolio', compact('profile'))->render();
        return response()->json(['message' => "Your portfolio deleted!", 'view' => $view]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function avatarUpdate(Request $request)
    {
        $this->validate($request, [
            'avatar' => config('croppie.validator'),
        ]);

        if(!$request->hasFile('avatar')){
            return response()->json([
                "message" => __('lui-croppie::form.invalid_file_error_message'),
                "errors" => [
                    'avatar' => 'Invalid request/file uploaded.',
                ]
            ], 422);
        }

        $file_path = (new ImageCropRepository())->handle($request->file('avatar'));

        if($file_path){

            $user = \Auth::user();
            if($user->avatar != config('croppie.default_avatar')) {
                ImageCropRepository::deleteFileIfExists($user->avatar);
            }
            $user->avatar = $file_path;
            $user->save();


            return response()->json([
                'success' => True,
                'uploaded_image_url' => asset('storage/' . $file_path),
                'redirect_url' => config('croppie.redirect_on_success'),
                'message' => __('The :attribute uploaded successfully.', [
                    'attribute' => 'avatar',
                    'ATTRIBUTE' => Str::upper('avatar'),
                    'Attribute' => Str::title('avatar'),
                ]),
            ]);
        }
    }






}
