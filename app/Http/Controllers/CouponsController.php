<?php

namespace App\Http\Controllers;

use App\Coupons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function checker(Request $request)
    {

     
        $request->validate([
            'api_key' => 'required|string',
            'code' => 'required|string|regex:/^[\p{L} 0-9]+$/u|min:5|max:20',
            
        ], $message = [
            'required' => '* يرجى ادخال رمز كوبون ',
            'code.regex' => '* يرجى ادخال رمز صالح ',
            'code.max' => '* يرجى ادخال رمز صالح ',
            'code.min' => '* يرجى ادخال رمز صالح ',

        ]);
        $API_KEY_GET = $request->api_key;
        $OID = $request->OID;
        $coupon_code = $request->code;
        if(env('API_KEY') == $API_KEY_GET){
            $coupons = DB::table('coupons')
            ->where('code', $coupon_code)
            ->get();
            $coupons_count = $coupons->count();
            $editdata = [
                'coupon_code' => $coupon_code,
            ];
            if($coupons_count > 0){
                $stmt = DB::table('payment_systems')
                ->where('OID',$OID)
                ->update($editdata);
                return response()->json($coupons);

            }else{
                return  response()->json(['errors' => ['code' => ['* رمز كوبون خاطئ '] ]],422);
            }
        }else{
            return  response()->json(['message' => 'Authentication failed'], 500);
        }
    
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coupons  $coupons
     * @return \Illuminate\Http\Response
     */
    public function show(Coupons $coupons)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coupons  $coupons
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupons $coupons)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coupons  $coupons
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupons $coupons)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coupons  $coupons
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupons $coupons)
    {
        //
    }
}
