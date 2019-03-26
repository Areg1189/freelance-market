<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RequestForCompletion extends Notification
{
    use Queueable;
    private $message;
    private $contract;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($contract)
    {
        $this->contract = $contract;


        $this->message = '<a href="'.route('freelancers.show', $contract->freelancer->user->slug).'">'.$contract->freelancer->user->name .'</a> applied for completion <a href="'.route('job.show', $contract->job->slug).'">job</a> finished';

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
            ->greeting('Freelancer has applied for completion.')
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
            'title' => 'Freelancer has applied for completion.',
            'redirect_url' => route('employer.job.show',['slug'=> $this->contract->job->slug,'open'=>'waiting']),
            'message' => $this->message,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'alert_type' => 'info',
            'title' => 'Freelancer has applied for completion.',
            'redirect_url' => route('employer.job.show',['slug'=> $this->contract->job->slug,'open'=>'waiting']),
            'message' => $this->message,
        ]);
    }
}
