<?php

namespace App\Http\Controllers\Replaceables;

use App\Http\Controllers\Controller;
use App\Models\Replacables\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::query()->get();

        return Inertia::render('Dashboard',[
            'employees' => $employees ?? [],
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
            // 'role_id' => 'integer|exists:roles,id',
        ]);

        Employee::firstOrCreate(
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'birth_date' => Carbon::parse($request->birth_date, 'UTC')->setTimezone('Europe/Vilnius')->format('Y-m-d'),
                // 'role_id' => $request->role_id,
            ]
        );
        return to_route('employee.index');
    }
}
