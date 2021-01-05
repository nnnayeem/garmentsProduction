<?php

namespace App\Services\Traits;

use App\Employee;
use Carbon\Carbon;

trait EmployeeTrait
{

    public function findEmployeeSkillByMinute($employee)
    {

        if (!empty($employee)) {
            $production_platform_data = $employee->production_platform;
            $production_platform_data = $production_platform_data->avg('task_done');
        } else
            $production_platform_data = 0;
        return number_format((float)$production_platform_data, 2, '.', '');
    }

    public function findEmployeeSkillByHour($employee){
        if (!empty($employee)) {
            $production_platform_data_hour = $employee->production_platform()->get()->groupBy(function ($item) {
                return Carbon::parse($item->created_at)->format('H');
            })
            ;
            $task_done_in_hour = [];

            foreach ($production_platform_data_hour as $item){
                $task_done_avg = $item->sum('task_done');
                $task_done_avg = $task_done_avg/60;
                array_push($task_done_in_hour, $task_done_avg);
            }

            $total_item = count($task_done_in_hour);

            if($total_item > 0){
                $hour_avg =  array_sum($task_done_in_hour)/$total_item;
                return number_format((float)$hour_avg, 2, '.', '');
            }
            return 0.00;

        } else
            return 0.00;

    }
}
