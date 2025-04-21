<?php

namespace App\Http\Controllers\Replaceables;

use App\Http\Controllers\Controller;
use App\Models\Replacables\Employee;
use App\Models\Replacables\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::whereRaw('deleted_at is null')->with('role')->get();

        return Inertia::render('Dashboard', [
            'employees' => $employees ?? [],
            'roles' => Role::select('id', 'name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees',
            'phone' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'role' => 'required',
        ]);

        Employee::firstOrCreate(
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'employed_at' => Carbon::now('Europe/Vilnius'),
                'birth_date' => Carbon::parse($request->birth_date, 'UTC')
                    ->setTimezone('Europe/Vilnius')
                    ->format('Y-m-d'),
                'role_id' => $request->role['id'],
            ]
        );

        return to_route('employee.index');
    }

    public function update(Request $request, $employeeId)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees,email,' . $request->id,
            'phone' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'role' => 'required',
        ]);
        
        Employee::where('id', $employeeId)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'birth_date' => Carbon::parse($request->birth_date, 'UTC')
                ->setTimezone('Europe/Vilnius')
                ->format('Y-m-d'),
            'role_id' => $request->role['id'],
        ]);

        return to_route('employee.index');
    }

    public function destroy($employeeId)
    {
        Employee::where('id', $employeeId)->update([
            'terminated_at' => Carbon::now('Europe/Vilnius')->format('Y-m-d H:i:s'),
        ]);

        Employee::where('id', $employeeId)->delete();

        return to_route('employee.index');
    }
}
