<?php

namespace App\Notifications;

use App\Models\Freelancer;
use App\Models\Job;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class JobApply extends Notification
{
    use Queueable;

    private $proposal;
    private $message;
    private $slug;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($proposal, $slug)
    {
        $this->slug = $slug;
        $this->proposal = $proposal;
        $this->message = $this->proposal->job->title.' has applied for your job <a href="'.route('freelancers.show', $this->proposal->freelancer->user->slug).'">'.$this->proposal->freelancer->full_name.'</a> freelancer </br> <a href="">View Proposal</a>';
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
            ->greeting('You have a new proposal.')
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
            'title' => 'You have a new proposal.',
            'redirect_url'=> route('employer.job.show', $this->slug),
            'message' => $this->message,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'alert_type' => 'info',
            'title' => 'You have a new proposal.',
            'redirect_url'=> route('employer.job.show', $this->slug),
            'message' => $this->message,
        ]);
    }
}
