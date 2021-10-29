<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifiyEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->content = $content;
    }


    /**
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("رسالة تفعيل الحساب ")->markdown('emails.VerifiyEmail')->with('content',$this->content);
    }
}
