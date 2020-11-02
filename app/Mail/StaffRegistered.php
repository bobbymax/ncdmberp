<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;

class StaffRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $staff;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $staff)
    {
        $this->staff = $staff;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.staffs.registered');
    }
}
