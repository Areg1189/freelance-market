<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class JobProhibited extends Notification
{
    use Queueable;
    private $prohibited;
    private $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($prohibited)
    {
        $this->prohibited = $prohibited;
        $this->message = '<strong>' . $this->job->title . '</strong>' .
            '<p>' . $this->job->description . '</p>' .
            '<a href="' . route('job.show', $this->job->slug) . '" target="_blank">View Job</a>';

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
            ->greeting($this->user->name . 'Posted New Job')
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
            'title' => $this->user->name . ' Posted New Job',
            'message' => $this->message,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message' => $this->message,
            'alert_type' => 'info',
            'title' =>$this->user->name.' Posted New Job',
        ]);
    }
}