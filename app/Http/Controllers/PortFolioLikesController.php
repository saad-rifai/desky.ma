<?php

namespace App\Http\Controllers;

use App\PortFolioLikes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;



class PortFolioLikesController extends Controller
{
    public function CheckWorkLike(Request $request){
        if(Auth::check()){
            $count = PortFolioLikes::where('to', $request->portfolio_id)->where('from', Auth::user()->Account_number)->count();
            if($count > 0){
                $already_liked = true;
            }else{
                $already_liked = false;
            }
            return response()->json(['already_liked' => $already_liked, 'show_like' => true],200);
        }else{
            return response()->json(['already_liked' => false, 'show_like' => false],200);
        }
    }
    public function likePortfolio(Request $request){
        if(Auth::check()){
            if(isset($request->like) && isset($request->portfolio_id)){
                if($request->like == 1){
                    $checkLike = PortFolioLikes::where('from', Auth::user()->Account_number)->where('to', $request->portfolio_id)->count();
                    if($checkLike < 1){
                        $stmt = PortFolioLikes::create([
                            'from' => Auth::user()->Account_number,
                            'to' => $request->portfolio_id,
                        ]);
                        if($stmt){
                            return response()->json('success', 200);
                        }else{
                            return response()->json('error', 400);
      
                        }
                    }else{
                        return response()->json(['error' => 'قمت بالاعجاب بهذا العمل من قبل !'], 403);

                    }

    
                }elseif($request->like == 0){
                    $stmt = PortFolioLikes::where('from', Auth::user()->Account_number)->where('to', $request->portfolio_id)->delete();
                   
                    if($stmt){
                        return response()->json('success', 200);
                    }else{
                        return response()->json('error', 400);
  
                    }
                }
    
            }
        }
  
    }
}
