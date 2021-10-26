<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
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
     * ->from('noreply@desky.ma', 'desky.ma')
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("اعادة تعيين كلمة المرور ")->markdown('emails.Reset_Password')->with('content',$this->content);
    }
}
