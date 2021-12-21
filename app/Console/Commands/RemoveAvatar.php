<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\FilesToRemove;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
class RemoveAvatar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:removeavatar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete User image after refreshing the cache';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dateNow = date("Y-m-d H:i:s");
        $data = FilesToRemove::where("date_to_remove" ,"<", $dateNow)->get();
        $ControllerFunctions = new Controller;


        foreach($data as $data){
            $s3FileUrl = $ControllerFunctions->GetS3FileDirection($data->filepath);

            if(Storage::disk('s3')->delete($s3FileUrl)){
                FilesToRemove::where('id', $data->id)->delete();

            }


        }


    }
}
