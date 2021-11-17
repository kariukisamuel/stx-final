<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;
use App\Http\Controllers\ApiResponseController as ApiResponseController;
use App\Http\Controllers\StripeEMailsController as Email;

class StripePaymentsController extends ApiResponseController
{
    public function processPayment(Request $request){

        $input = $request->all();
        $validator = Validator::make($input, [
            'amount' => 'required|integer',
            'currency'=>'required',
            'email'=>'required',
            'token'=>'required',
            'payment_interval' => 'required'
            
        ]);

        if($validator->fails()){
            return $this->handleError($validator->errors());       
        }

        try {
                //set up key
                Stripe::setApiKey(config('services.stripe.secret'));
                //create customer
                $customer =  Stripe::customers()->create([
                    'email' => $request->email,         
                ]);

                Email::store(
                    [
                       'email' => $request->email,
                        'stripe_customer_id'=>$customer['id'],
                    ]
                );

                //create card belonging to customer
                $card = Stripe::cards()->create($customer['id'], $request->token);
                //charge customer

                if($request->payment_interval == 0){
                    $charge = Stripe::charges()->create([
                        'customer' => $customer['id'],
                        'currency' => $request->currency,
                        'amount'   => $request->amount,
                    ]);
                    return $this->handleResponse($charge, 'Single Payment Was Successful');
                  }
                  else{
                      $amount = $request->amount / 2;
                      $firstCharge = Stripe::charges()->create([
                        'customer' => $customer['id'],
                        'currency' => $request->currency,
                        'amount'   => $amount,
                      ]);
                      sleep($request->payment_interval);
                      $secondCharge = Stripe::charges()->create([
                        'customer' => $customer['id'],
                        'currency' => $request->currency,
                        'amount'   => $amount,
                      ]);
                    
                      return $this->handleResponse(array_merge($firstCharge,$secondCharge), 'Double Payment Was Successful');
                     
                  }
             
            } catch (CardErrorException $e) {
               throw $e; 
            } 



  
    }
}
