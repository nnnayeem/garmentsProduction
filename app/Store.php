<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'stores';

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
    protected $fillable = [
        'machine_category_id',
        'qty',
        'price',
        'type',
    ];


    public function machines(){
        return $this->hasMany('App\Machine');
    }

    public function machineCategory()
    {
        return $this->belongsTo('App\MachineCategory');
    }

    
}
