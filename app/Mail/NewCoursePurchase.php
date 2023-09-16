<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewCoursePurchase extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details  =   $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): NewCoursePurchase
    {
        return $this->from('no-reply@speakede.com')
            ->view('mail.course-purchase-booking')->with(['details'=>$this->details]);
    }
}
