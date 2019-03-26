<?php

namespace App\Notifications;

use App\Models\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ProposalAccepted extends Notification
{
    use Queueable;
    private $job;
    private $proposal;
    private $from;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($slug, $proposal, $from)
    {
        $job = Job::find($slug);
        $this->job = $job;
        $this->proposal = $proposal;
        $this->from = $from;
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
        if($this->from == 'EMPLOYER'){
            $url = url('dashboard/my-offers');
            return (new MailMessage)
                ->greeting('Hello!')
                ->line('Your proposal accepted for "'.$this->job->title.'" job.')
                ->action('Notification Action', $url)
                ->line('Thank you for using our application!');
        }else{
            $url = url('/accept/employer-offers/'.$this->job->slug);
            return (new MailMessage)
                ->greeting('Hello!')
                ->line('Your proposal accepted for "'.$this->job->title.'" job.')
                ->action('Notification Action', $url)
                ->line('Thank you for using our application!');
        }

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
            'type'=>'job_accept',
            'job' => json_encode($this->job),
            'from' => $this->from
        ];
    }
}
