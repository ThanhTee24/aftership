<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Paypal_acconut extends Model
{
    protected $table = 'paypal_account';

    protected $fillable = [
        'to_date', 'from_date', 'paypal_account'
    ];
}
