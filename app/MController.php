<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MController extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'm_controllers';

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
    protected $fillable = ['floor_id','serial', 'ip', 'line_no', 'line_title'];


    public function floor()
    {
        return $this->belongsTo('App\Floor');
    }


}
