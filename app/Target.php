<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'targets';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['order_id', 'floor_id', 'line','target','day'];

    public function order(){
        return $this->belongsTo('App\Order','order_id');
    }
    public function details(){
        return $this->hasMany('App\TargetDetails','target_id');
    }
    public function targetHourlyDetails(){
        return $this->hasMany('App\TargetHourlyDetail','target_id');
    }

    
}
