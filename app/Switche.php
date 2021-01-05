<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Switche extends Model
{
    protected $table = 'switches';

    protected $fillable = ['floor_id','switch','status','checked'];

    public function employee()
    {
        return $this->hasOne(Employee::class, 'switch_id');
    }

    public function floor()
    {
        return $this->belongsTo(Floor::class, 'floor_id');
    }

    public function production_platforms()
    {
        return $this->hasMany(ProductionPlatform::class, 'switch_id');
    }
}
