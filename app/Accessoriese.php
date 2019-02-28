<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accessoriese extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'accessorieses';

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
    protected $fillable = ['name', 'order_id', 'qty', 'unit','stored','delivered','lc','amount','balance'];

    public function order(){
        return $this->belongsTo('App\Order');
    }

    
}
