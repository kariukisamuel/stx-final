<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stripeEMails extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'stripe_customer_id',
    ];
}
