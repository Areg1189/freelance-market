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
Route::get('/', 'HomeController@index')->name('home');
Route::get('/test', 'YandexController@test')->name('test');
Route::get('/page/{slug?}', 'HomeController@page')->name('page');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::get('change/country/{country?}', 'Admin\AdminController@changeCountry')->name('admin.change_country');
    Route::group(['prefix' => 'visit-log'], function () {
        Route::get('/', 'Admin\VisitLogController@index')->name('__visitlog__');
        Route::delete('delete_visitlog/{id}', 'Admin\VisitLogController@destroy')->name('__delete_visitlog__');
        Route::delete('delete_visitlog_all', 'Admin\VisitLogController@destroyAll')->name('__delete_visitlog_all__');
    }
    );
});

Auth::routes();


//  FRONTEND

//  JOB ROUTE
Route::resource('/job', 'JobController');
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/job-favorite/{job}', 'JobController@favorite')->name('job.favorite');
    Route::get('/new-proposal/{slug}', 'JobController@newProposal')->name('job.new_proposal');
    Route::post('/new-proposal/{slug}', 'JobController@storeProposal')->name('job.store_proposal');
    Route::post('/job-before-create', 'JobController@beforeCreate')->name('job.before_create');

    Route::post('/accept-job-finished/{job}/{freelancer}', 'JobController@acceptJobFinished')->name('job.accept_finished');
    Route::post('/show-contract-history/{freelancer}', 'JobController@acceptJobFinished')->name('job.accept_finished');
});
// Support ROUTE


Route::get('/support', 'SupportController@index')->name('support.show');
Route::get('/support-description', 'SupportController@showDescription')->name('support.description');
Route::get('/support-result', 'SupportController@showResult')->name('support.result');
Route::get('/faq', 'SupportController@showContacts')->name('faq.show');
Route::post('/send-email', 'SupportController@send')->name('support.send');
Route::post('/support-likes', 'SupportController@showHistory')->name('support.like');
Route::get('/send-emailss', 'SupportController@sendGet')->name('support.send.get');


//  FREELANCER ROUTE
Route::resource('/freelancers', 'FreelancerController');

Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'f-my'], function () {

//    Route::get('/jobs', 'ProfileController@myJobs')->name('my.jobs');
//    Route::get('/jobs/{slug?}', 'ProfileController@myJobs')->name('freelancer.jobs');
//    Route::get('/offers', 'FreelancerController@offers')->name('freelancer.offers');
    Route::get('/proposal', 'FreelancerController@proposal')->name('freelancer.proposal');
    Route::get('/favorite', 'FreelancerController@favorite')->name('freelancer.favorite');
    Route::get('/contracts/{status}', 'FreelancerController@contracts')->name('freelancer.contracts');
    Route::get('/reports', 'FreelancerController@reports')->name('freelancer.reports');
    Route::get('/show-proposal/{job_slug}', 'FreelancerController@showProposal')->name('freelancer.show_proposal');

});

Route::get('/payment','PaymentController@show')->name('payment.show');

//  EMPLOYER ROUTE
Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'emp'], function () {
    Route::get('/my/jobs/{status?}', 'EmployerController@jobs')->name('employer.job');
    Route::get('/my/job/{slug}/{open?}', 'EmployerController@job')->name('employer.job.show');
    Route::get('/my/contracts/{status}', 'EmployerController@contracts')->name('employer.contracts');
    Route::get('/my/reports', 'EmployerController@reports')->name('employer.reports');
});


//  PROFILE ROUTE


Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::group(['prefix' => 'profile'], function () {
        Route::get('', 'ProfileController@show')->name('profile');
        Route::get('edit', 'ProfileController@edit')->name('profile.edit');
        Route::post('update', 'ProfileController@updateFreelancer')->name('profile.update.freelancer');
        Route::post('up-date', 'ProfileController@updateEmployer')->name('profile.update.employer');
        Route::put('avatar-update', 'ProfileController@avatarUpdate')->name('profile.avatar.update');

      });
    });

    Route::group(['middleware' => ['auth', 'verified']], function () {
        Route::group(['prefix' => 'settings'], function () {
            Route::get('', 'SettingController@index')->name('settings');
        });
    });

    Route::group(['prefix' => 'portfolio'], function () {
        Route::get('/edit-portfolio/{id}', 'ProfileController@editPortfolio')->name('edit.portfolio');
        Route::post('/update-portfolio/{id}', 'ProfileController@updatePortfolio')->name('update.portfolio');
        Route::post('/store-portfolio', 'ProfileController@storePortfolio')->name('store.portfolio');

        Route::post('/hide-portfolio/{id}', 'ProfileController@hidePortfolio')->name('hide.portfolio');
        Route::post('/delete-portfolio/{id}', 'ProfileController@deletePortfolio')->name('delete.portfolio');

    });

    Route::group(['prefix' => 'search'], function () {
        Route::post('/save', 'SearchController@save')->name('search.save');
    });


//  LOGOUT ROUTE

    Route::get('/logout', function () {
        Auth::logout();
        return redirect()->route('home');
    })->name('logout');


//  SKILLS ROUTE

Route::get('/skills/find', 'AjaxController@skillsFind')->name('skills.find');

/**
 * Laravel messenger routes.
 */

Route::prefix('messenger')->group(function () {
    Route::get('t/{slug?}', 'MessageController@laravelMessenger')->name('messenger');
    Route::post('send', 'MessageController@store')->name('message.store');
    Route::get('threads', 'MessageController@loadThreads')->name('threads');
    Route::get('more/messages', 'MessageController@moreMessages')->name('more.messages');
    Route::delete('delete/{id}', 'MessageController@destroy')->name('delete');
    // AJAX requests.
    Route::prefix('ajax')->group(function () {
        Route::post('make-seen', 'MessageController@makeSeen')->name('make-seen');
    });

});

//  PayPal ROUTE

Route::group(['prefix' => 'invoice', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/invoices', 'InvoiceController@invoices')->name('paypal.invoices');
    Route::get('/create-invoice/{slug}', 'InvoiceController@createAndSendInvoice')->name('paypal.invoice.create');

    Route::get('/new-invoice', 'InvoiceController@newInvoice')->name('paypal.invoice.new');
    Route::post('/cancel/{id?}', 'InvoiceController@cancelInvoice')->name('paypal.invoice.cancel');


});

Route::any('/invoice/event', 'InvoiceController@event')->name('paypal.invoice.event');


Route::group(['prefix' => 'notifications', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/', 'NotificationsController@index')->name('notifications.index');
    Route::post('/mark-as-read/{notif_id?}', 'NotificationsController@markAsRead')->name('notifications.mark-as-read');
});


// Apply Job ROUTE
Route::group(['prefix' => 'apply', 'middleware' => ['auth', 'verified']], function () {

    Route::post('/cancel-apply/{slug}', 'ApplyController@store')->name('apply.cancel');

});


//  OFFER ROUTE
Route::group(['prefix' => 'offer', 'middleware' => ['auth', 'verified']], function () {
    Route::post('/send/{slug?}', 'OfferController@send')->name('offer.send');

    Route::get('/accept/{freelancerJobOffer}', 'OfferController@accept')->name('offer.accept');
    Route::get('/cancel/{freelancerJobOffer}', 'OfferController@cancel')->name('offer.cancel');

//    Route::post('/employer-accept', 'AcceptController@acceptEmployer')->name('employer.accept');
//    Route::post('/employer-cancel', 'AcceptController@cancelEmployer')->name('employer.cancel');
//
//    Route::post('/freelancer-accept', 'AcceptController@acceptFreelancer')->name('freelancer.accept');
//    Route::post('/freelancer-cancel', 'AcceptController@cancelFreelancer')->name('freelancer.cancel');

});

//   CONTRACT ROUTE
Route::group(['prefix' => 'contracts', 'middleware' => ['auth', 'verified']], function () {
    Route::post('send-finished-contract/{contract}', 'ContractController@sendFinishedJob')->name('contract.finished.freelancer');
    Route::get('/show-contract-cancel-modal/{from}/{contract}', 'ContractController@showContractCancelModal')->name('contract.show_contract_cancel_modal');

    Route::post('send-closed-contract/{from}/{contract}', 'ContractController@sendCancelContract')->name('contract.closed');


    Route::get('get-history/{contract}', 'ContractController@getHistory')->name('contract.history');
    Route::post('send-no-accept-job/{contract}', 'ContractController@sendNoCommentJob')->name('contract.closed.employer');
    Route::post('send-accept-job/{contract}', 'ContractController@sendCommentJob')->name('contract.accept.employer');
    Route::get('feedback/{contract}/{recipient}', 'ContractController@createFeedback')->name('contract.feedback.create');
    Route::post('feedback-store/{contract}/{recipient}', 'ContractController@storeFeedback')->name('contract.feedback.store');

});


Auth::routes(['verify' => true]);