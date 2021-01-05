<?php
namespace App\Services\Traits;

trait GenerateGraphTrait{
    public function sumColByDayWithAppropriateFormat(String $col, iterable $data):array
    {
        $xAxis = [];
        $yAxis = [];
        foreach ($data as $key => $items){
            $summationValue = $items->sum($col);
            if($summationValue > 0){
                array_push($xAxis, $key);
                array_push($yAxis, $summationValue);
            }
        }
        return [$xAxis, $yAxis];
    }
}
