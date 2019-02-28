<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TargetDetails extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'target_details';

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
    protected $fillable = ['target_id', 'floor_id', 'line','type','qty'];
}
