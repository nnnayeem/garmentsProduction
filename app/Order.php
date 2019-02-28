<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

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
    protected $fillable = ['name', 'buyer_id', 'qty', 'ending_date','master_lc','start_date','amount','expense','production'];

    public function buyer(){
        return $this->belongsTo('App\Buyer');
    }
    public function accessories(){
        return $this->hasMany('App\Accessoriese');
    }

    
}
