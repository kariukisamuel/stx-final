<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\SuccessfulPaymentNotification as SuccessfulPayment;
use App\Http\Controllers\ApiResponseController as ApiResponseController;
use GrahamCampbell\ResultType\Success;

class EmailController extends ApiResponseController
{
    public function sendMail(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'to'=>'required',
            'email_title' => 'required',
            'email_body'=>'required',

        ]);
        if($validator->fails()){
            return $this->handleError($validator->errors());       
        }
        $emailBody = [
            'to' => $request->to,
            'email_title' => $request->email_title,
            'email_body' => $request->email_body
        ];
      
       
       \Mail::to($emailBody['to'])->send(new SuccessfulPayment($emailBody));
       $receipient = $emailBody['to'];
       return $this->handleResponse(['email_sent_to'=>$receipient],'The email was sent successfully!');
        
    }
}
