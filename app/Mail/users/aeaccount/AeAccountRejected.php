<?php

namespace App\Mail\users\aeaccount;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AeAccountRejected extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $content;
    public function __construct($content)
    {
        $this->content = $content;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@desky.ma', 'desky.ma')->subject("بخصوص طلب تفعيل حساب المقاول الذاتي")->markdown('emails.users.aeaccount.RequestRejected')->with('content',$this->content);
    }
}
