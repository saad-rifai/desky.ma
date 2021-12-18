<?php

namespace App\Jobs;

use App\Mail\NewOffer;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;


class NewOffersMailNot implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $datajob;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct($datajob)
    {
        $this->datajob = $datajob;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

   /*
     $userInfos = User::where('Account_number', $this->datajob['to'])->get(['email', 'frist_name']);

     foreach($userInfos as $userInfo);

     if(!User::isOnline($this->datajob['to'])){
         $data = [
             'user_name' => $userInfo->frist_name,
             'OID' => $this->datajob['OID'],
             'offer_id' => $this->datajob['offer_id'],
             'order_title' => $this->datajob['order_title'],
         ];
        Mail::to($userInfo->email)->send(new NewOffer($data));

     }else{
         return true;
     }
*/
    }
}
