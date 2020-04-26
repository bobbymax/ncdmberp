<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\TrainingDetail;

class TrainingCategorised extends Notification
{
    use Queueable;

    protected $detail;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(TrainingDetail $detail)
    {
        $this->detail = $detail;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // dd($notifiable);
        return ['mail', 'database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'type' => 'training',
            'trainingID' => $this->detail->id,
            'title' => $this->detail->training->title,
            'status' => $this->detail->status,
            'start_date' => $this->detail->start_date->format('d M'),
            'duration' => $this->detail->duration(),
        ];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
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
            //
        ];
    }
}
