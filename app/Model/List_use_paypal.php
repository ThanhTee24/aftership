<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class List_use_paypal extends Model
{
    protected $table = 'list_use_paypal';

    protected $fillable = [
        'to_date', 'from_date', 'paypal_account'
    ];
}
