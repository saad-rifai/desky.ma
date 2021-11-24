<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use App\FilesToRemove;
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
        foreach($data as $data){
            $path = public_path().'/'.$data->filepath;
            if(file_exists($path)) {
                unlink($path);
            }

            FilesToRemove::where('id', $data->id)->delete();
        }


    }
}
