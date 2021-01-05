<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = ['id'];

    public function switch()
    {
        return $this->belongsTo(Switche::class);
    }

    public function production_platform()
    {
        return $this->hasMany(ProductionPlatform::class);
    }
}
