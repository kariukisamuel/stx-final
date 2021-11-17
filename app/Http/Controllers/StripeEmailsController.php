<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\stripeEMails;

class StripeEMailsController extends Controller
{
    public static function store($email){
        $email = stripeEMails::create($email);
        return $email;
    }
}
