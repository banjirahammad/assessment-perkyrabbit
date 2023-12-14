<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use App\Services\DepartmentService;
use App\Services\EmployeeService;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::latest()->paginate(10);
        return view('department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('department.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartmentRequest $request, DepartmentService $departmentService)
    {
        $departmentService->store(
            $request->validated()
        );
        return redirect()->back()->with(['success' => 'Department Add Successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('department.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request, Department $department, DepartmentService $departmentService)
    {
        $departmentService->update(
            $department,
            $request->validated()
        );
        return redirect()->route('department.index')->with('success','Department Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department, DepartmentService $departmentService)
    {
        $departmentService->destroy(
            $department
        );

        return response('Department deleted');

    }
}
