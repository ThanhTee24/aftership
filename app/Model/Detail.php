<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Delivery_status;

class Detail extends Model
{
    protected $table = 'detail';

    protected $fillable = [
        'tracking_number', 'process_content', 'process_date',
        'tracking_status', 'step_number', 'delivery_status', 'total_day', 'note', 'tracking_id'
    ];

    public function scopeProcess_content($query, $process_content){
        return $query->where('process_content', 'like', '%'. $process_content . '%');
    }

    public function scoprProcess_date($query, $process_date){
        return $query->where('detail.process_date', $process_date);
    }

    public function scoprTotal($query, $total){
        return $query->where('detail.total_day', $total);
    }

    public function Delivery(){
        return $this->belongsTo(Delivery_status::class,'delivery_status', 'id');
    }

    public function detail_tracking(){
        return $this->hasOne(Tracking::class);
    }
}
