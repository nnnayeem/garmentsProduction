<?php

namespace App\Http\Controllers\Admin;

use App\Employee;
use App\Floor;
use App\Services\Traits\EmployeeTrait;
use App\Services\Traits\GenerateGraphTrait;
use App\Switche;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Validator;

class EmployeeController extends Controller
{
    use EmployeeTrait, GenerateGraphTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $floors = Floor::pluck('title', 'id')->all();
        $employees = Employee::with('switch', 'switch.floor')->get();
        return view('admin.employee.index', compact('employees', 'floors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $floors = Floor::pluck('title', 'id')->all();
        return view('admin.employee.create', compact('floors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:191',
            'phone' => 'required|max:11',
            'companyID' => 'max:20',
        ];
        $message = [];

        $form_data = Validator::make($request->all(), $rules, $message)->validate();

        Employee::create($form_data);

        return redirect(route('employees.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        $employee = Employee::find($id);

        $hourlySkill = $this->findEmployeeSkillByHour($employee);
        $minuteSkill = $this->findEmployeeSkillByMinute($employee);

//        dd($employee);
        return view('admin.employee.show', compact('employee', 'hourlySkill','minuteSkill'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $floors = Floor::pluck('id', 'title')->all();
        $employee = Employee::find($id);

        return view('admin.employee.edit', compact('employee', 'floors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);


        $rules = [
            'name' => 'required|max:191',
            'phone' => 'required|max:11',
            'companyID' => 'max:20',
        ];
        $message = [];

        $form_data = Validator::make($request->all(), $rules, $message)->validate();

        $employee->update($form_data);

        return redirect(route('employees.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Employee::destroy($id);

        return redirect(route('employees.index'));
    }

    public function setEmployeeToSwitch(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $rules = [
            'floor_id' => 'required|integer',
            'switch' => 'required|integer',
        ];
        $message = [];

        $form_data = Validator::make($request->all(), $rules, $message)->validate();

        $switch = Switche::where('floor_id', $form_data['floor_id'])
            ->where('switch', $form_data['switch'])
            ->first();

        if (!empty($switch)) {
            $employee->update(['switch_id' => $switch->id]);
        }

        return redirect(route('employees.index'));

    }

    public function EmployeeDailyTaskDoneReport($id)
    {
        $employee = Employee::findOrFail($id);

        $firstDay = now()->firstOfMonth();
        $lastDayOfMonth = now()->endOfMonth();

        $productionPlatformData = $employee->production_platform()->whereBetween('created_at', [$firstDay, $lastDayOfMonth])->orderBy('created_at', 'asc')->get()->groupBy(function($query){
            return Carbon::parse($query->created_at)->format('d');
        });

        return $this->sumColByDayWithAppropriateFormat('task_done', $productionPlatformData);
    }

    public function EmployeeMonthlyTaskDoneReport($id)
    {
        $employee = Employee::findOrFail($id);

        $firstDay = now()->format("Y-01-01");
        $lastDayOfMonth = now()->format("Y-m-d");

        $productionPlatformData = $employee->production_platform()->whereBetween('created_at', [$firstDay, $lastDayOfMonth])->orderBy('created_at', 'asc')->get()->groupBy(function($query){
            return Carbon::parse($query->created_at)->format('M');
        });

        return $this->sumColByDayWithAppropriateFormat('task_done', $productionPlatformData);
    }
}
