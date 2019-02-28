<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'floors';

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
        'floor',
        'title',
        'rows',
        'MachinePerRow',



    ];

    public function machines()
    {
        return $this->hasMany("App\Machine");
    }
    public function switches()
    {
        return $this->hasMany('App\Switche');
    }
    public function targets(){
        return $this->hasMany('App\Target','floor_id');
    }

    
}
