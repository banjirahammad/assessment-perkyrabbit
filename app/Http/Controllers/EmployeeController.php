<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Department;
use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Services\EmployeeService;
use Illuminate\Http\Request;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::orderBy('name')->get();
        $employees = Employee::with('department','achievements')->latest()->paginate(10);
        return view('employee.index', compact('employees', 'departments'));
    }


    public function myFilter(Request $request, EmployeeService $employeeService)
    {
        $employees = $employeeService->getMine($request->query());
        $departments = Department::orderBy('name')->get();

        return view('employee.index', compact('employees','departments'));

    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::orderBy('name')->get();
        $achievements = Achievement::orderBy('name')->get();
        return view('employee.create', compact('departments','achievements'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request, EmployeeService $employeeService)
    {
        $employeeService->store(
            $request->validated()
        );
        return redirect()->back()->with(['success' => 'Employee Successfully Added']);

    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $departments = Department::orderBy('name')->get();
        $achievements = Achievement::orderBy('name')->get();
        return view('employee.edit', compact('employee','departments','achievements'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee, EmployeeService $employeeService)
    {
        $employeeService->update(
            $employee,
            $request->validated()
        );

        return redirect()->route('employee.index')->with('success','Employee Update Successfully');
//        return redirect()->route('employee.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee, EmployeeService $employeeService)
    {
        $employeeService->destroy(
            $employee
        );

        return response('Employee deleted');
    }
}
