<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Detail;

class Delivery_status extends Model
{
    protected $table = 'delivery_status';

    protected $fillable = [
        'name'
    ];

    public function scopeStatus($query, $status){
        return $query->where('delivery_status.name', 'like', '%'. $status . '%');
    }

    public function detail_delivery(){
        return $this->hasMany(Detail::class,'id');
    }
}
