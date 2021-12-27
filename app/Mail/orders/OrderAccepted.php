<?php

namespace App\Mail\orders;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderAccepted extends Mailable
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
        return $this->from('info@desky.ma', 'desky.ma')->subject("تمت الموافقة على طلبك رقم #".$this->content['OID']."")->markdown('emails.orders.OrderAccepted')->with('content',$this->content);
    }
}
