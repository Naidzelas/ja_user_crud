<?php

namespace App\Http\Controllers\Replaceables;

use App\Http\Controllers\Controller;
use App\Models\Replacables\Employee;
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
}
