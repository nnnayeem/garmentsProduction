<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'machines';

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
    protected $fillable = ['switch', 'floor_id', 'machine_token','checked','status','is_stored','machine_category_id'];

    public function floor()
    {
        return $this->belongsTo("App\Floor");
    }

    public function category()
    {
        return $this->belongsTo('App\MachineCategory','machine_category_id');
    }

    public function store(){
        return $this->belongsTo('App\Store');
    }

    
}
