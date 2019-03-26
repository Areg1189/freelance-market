<?php

namespace App\Models;



use Bnb\Laravel\Attachments\HasAttachment;

class Message extends \wDevStudio\LaravelMessenger\Models\Message
{

    use HasAttachment;
}
