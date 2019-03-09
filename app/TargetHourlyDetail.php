<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TargetHourlyDetail extends Model
{
    protected $fillable = ['target_id', 'red', 'green','yellow','start_time','end_time'];

    public function target(){
    	return $this->belongsTo('App\Target');
    }
}
