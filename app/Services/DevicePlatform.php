<?php


namespace App\Services;


use App\Events\CountProduction;
use App\MController;
use App\Services\Traits\EmployeeTrait;
use App\Switche;

class DevicePlatform
{
    use EmployeeTrait;

    public static function ExtractDataFromControllerIncomingData($factoryControllerData): array
    {


        if (sizeof($factoryControllerData) == 2) {
            $controllerData = $factoryControllerData[0];
            $switchNo = $factoryControllerData[1];
            $controllerData = explode(':', $controllerData);
            $ip = $controllerData[0];
            $status = $controllerData[1];

            $controller = MController::with('floor')->where('ip', $ip)->first();
            $productionStartsAt = $controller->production_switch_start_at;
            $isProductionSwitch = false;

            if (!empty($controller)) {
                $rowNo = $controller->line_no;
                $floor = $controller->floor;
                if (!empty($floor)) {
                    //Detect if pressed switch is for production
                    if($switchNo >= $productionStartsAt){
                        $isProductionSwitch = true;
                        $originalSwitchNo = $switchNo - $productionStartsAt + 1;
                    }else{
                        $machinePerRow = $floor->machinePerRow;
                        $originalSwitchNo = (int)$machinePerRow * ((int)$rowNo - 1) + $switchNo;
                    }

                    return [
                        'floor' => $floor,
                        'originalSwitchNo' => $originalSwitchNo,
                        'status' => $status,
                        'is_production_switch' => $isProductionSwitch,
                    ];
                }

                return [];
            }

        }
        return  [];

    }



    public static function ProcessProductionPlatformData($extractedData)
    {
        $switch = Switche::with('employee')->where('switch', $extractedData['originalSwitchNo'])
            ->where('floor_id', $extractedData['floor']->id)
            ->first();

        $employee = $switch->employee;

        /*
         * If User complete task within 1 minute increment
         * if user needs time to complte task more than 1 minute then create new record in production platform
         * */

        try{
            if(!empty($switch))
            {
                $productionPlatform = $switch->production_platforms()->latest()->first();

                if(empty($productionPlatform) || $productionPlatform->created_at->diffInMinutes(now()) > 0){
                    $switch->production_platforms()->create(['employee_id' => empty($employee)? 0: $employee->id]);
                }else{
                    $switch->production_platforms()->latest()->first()->increment('task_done');

                }

                return [
                    "status" => 202
                ];
            }
        }catch (\Exception $e){
            return [
                "status" => 200,
                "meta" => [
                    'errorMessage' => config('app.env') == 'local'?$e->getMessage():"Unknown Error Occurred"
                ]
            ];
        }

        return [
            "status" => 200,
            "meta" => [
                'errorMessage' => config('app.env') == 'local'?"Switch Not Found":"Unknown Error Occurred"
            ]
        ];
    }
}
