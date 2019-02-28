<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Switche extends Model
{
    protected $table = 'switches';
    protected $fillable = ['floor_id','switch','status','checked'];
}
