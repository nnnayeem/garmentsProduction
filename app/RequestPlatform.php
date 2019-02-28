<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestPlatform extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'request_platforms';

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
    protected $fillable = ['machine_category_id', 'machine_id', 'parts_id', 'partsName','approved','deliver'];

    public function machineCategory(){
        return $this->belongsTo('App\MachineCategory');
    }

    public function parts(){
        return $this->belongsTo('App\Part');
    }

    public function machine(){
        return $this->belongsTo('App\Machine');
    }

    
}
