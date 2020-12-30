<?php


namespace App\Services;


use App\MController;

class DevicePlatform
{
    public static function ExtractDataFromControllerIncomingData($factoryControllerData): array
    {
        $factoryControllerData = explode('>', $factoryControllerData);
        if (sizeof($factoryControllerData) == 2) {
            $controllerData = $factoryControllerData[0];
            $switchNo = $factoryControllerData[1];

            $controllerData = explode(':', $controllerData);
            $ip = $controllerData[0];
            $status = $controllerData[1];

            $controller = MController::with('floor')->where('ip', $ip)->first();
            if (!empty($controller)) {
                $rowNo = $controller->line_no;
                $floor = $controller->floor;
                if (!empty($floor)) {
                    $machinePerRow = $floor->machinePerRow;
                    $originalSwitchNo = (int)$machinePerRow * ((int)$rowNo - 1) + $switchNo;
                    return [
                        'floor' => $floor,
                        'originalSwitchNo' => $originalSwitchNo,
                        'status' => $status,
                    ];
                }

                return [];
            }

            return  [];


        }
    }
}
