<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendOffer extends Notification
{
    use Queueable;


    private $offer;

    private $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($offer)
    {
        $this->offer = $offer;
        $this->message = 'You have a new offer' /*$this->proposal->job->title.' has applied for your job <a href="'.route('freelancers.show', $this->proposal->freelancer->user->slug).'">'.$this->proposal->freelancer->full_name.'</a> freelancer </br> <a href="">View Proposal</a>'*/;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('You have a new offer.')
            ->line($this->message)
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'alert_type' => 'info',
            'title' => 'You have a new offer.',
            'redirect_url'=>route('freelancer.contracts', 'offers'),
            'message' => $this->message,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'alert_type' => 'info',
            'title' => 'You have a new offer.',
            'redirect_url'=>route('freelancer.contracts', 'offers'),
            'message' => $this->message,
        ]);
    }

}
