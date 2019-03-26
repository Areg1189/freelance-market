<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OfferAccept extends Notification
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

        $this->message = '<a href="'.route('freelancers.show', $offer->freelancer->user->slug).'">'.$offer->freelancer->user->name .'</a> confirmed your <a href="'.route('job.show', $offer->job->slug).'">job</a> offer';
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Your offer was answered.')
            ->line($this->message)
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'alert_type' => 'info',
            'title' => 'Your offer was answered.',
            'redirect_url'=> route('employer.job', 'in-processing'),
            'message' => $this->message,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'alert_type' => 'info',
            'title' => 'Your offer was answered.',
            'redirect_url' => route('employer.job', 'in-processing'),
            'message' => $this->message,
        ]);
    }
}
