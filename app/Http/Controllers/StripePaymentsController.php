<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ApiResponseController as ApiResponseController;

class StripePaymentsController extends ApiResponseController
{
    public function processPayment(Request $request){
        $input = $request->all();
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $validator = Validator::make($input, [
            'amount' => 'required|integer',
            'currency'=>'required',
            'email'=>'required',
            'token'=>'required'

        ]);

        if($validator->fails()){
            return $this->handleError($validator->errors());       
        }

        $charge =  \Stripe\Charge::create([
            'amount'=>$request->amount,
            'currency'=>$request->currency,
            'description'=>$request->email,
            'source'=>$request->token

        ]);

       dd($charge);



    }
}
