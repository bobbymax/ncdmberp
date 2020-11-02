<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\TrainingDetail;

class ConfirmedTraining extends Mailable
{
    use Queueable, SerializesModels;

    public $detail, $action;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(TrainingDetail $detail, $action)
    {
        $this->detail = $detail;
        $this->action = $action;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.staff.confirmed-training');
    }
}
