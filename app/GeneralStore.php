<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralStore extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'general_stores';

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
    protected $fillable = ['order_id','qty','delivered','user_id','accessoriese_id','delivered_qty'];
    public function order(){
        return $this->belongsTo('App\Order');
    }
    public function accessories(){
        return $this->belongsTo('App\Accessoriese','accessoriese_id');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }

    
}
