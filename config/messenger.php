<?php


return [

    /*
    |--------------------------------------------------------------------------
    | Messenger Default User Model
    |--------------------------------------------------------------------------
    |
    | This option defines the default User model.
    |
    */

    'user' => [
        'model' => 'App\Models\User'
    ],

    /*
    |--------------------------------------------------------------------------
    | Messenger Pusher Keys
    |--------------------------------------------------------------------------
    |
    | This option defines pusher keys.
    |
    */

    'pusher' => [
        'app_id'     => '697772',
        'app_key'    => '0665f36b9c489bbc5be6',
        'app_secret' => '1f625721acc16c784ea2',
        'options' => [
            'cluster'   => 'mt1',
            'encrypted' => true
        ]
    ],

    'attachment_allowed' => env('MESSAGE_ATTACHMENT_ALLOWED', 'json,pdf,doc,xls,docx,xlsx,jpg,png,gif,jpeg'),
    'attachment_max_size' => 5000,


    'file_path' => env('MESSAGE_FILE_PATH', 'messages-file')
];
