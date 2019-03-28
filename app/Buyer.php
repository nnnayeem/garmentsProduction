<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'buyers';

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
    protected $fillable = ['name', 'country', 'address', 'language','email','user_id'];

    public function orders(){
        return $this->hasMany('App\Order');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }

    
}
