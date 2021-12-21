<?php

namespace App\Jobs;

use App\Mail\VerifiyEmail;
use App\Mail\ResetPasswordMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $infos;
    public function __construct($infos)
    {
        $this->infos = $infos;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
  

        try {
            Mail::to($this->infos['to'])->send($this->infos['emailData']);
        } catch (\Exception $e) {
           // return 'Error - ' . $e;
              return response()->json(['Mail Filed !'], 500);
    
        }


    }
}
