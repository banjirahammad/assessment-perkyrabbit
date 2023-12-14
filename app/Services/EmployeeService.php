<?php

namespace App\Services;

use App\Filters\EmployeeFilter;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class EmployeeService
{

    public function store(array $data)
    {
        DB::transaction(function() use ($data) {
            $employee = Employee::create($data);
            if (isset($data['achievement_name'])){
                $employee->achievements()->sync(
                    $data['achievement_name']
                );
            }
        }, 5);

    }
    public function update(Employee $employee, array $data)
    {
        DB::transaction(function() use ($employee, $data) {
            $employee = tap($employee)->update($data);
            if (isset($data['achievement_name'])){
                $employee->achievements()->sync(
                    $data['achievement_name']
                );
            }
        }, 5);

    }

    public function getMine(array $queryParams = [])
    {
        $queryBuilder = Employee::latest();

        $employees = resolve(EmployeeFilter::class)->getResults([
            'builder' => $queryBuilder,
            'params' => $queryParams
        ]);

        return $employees;
    }

    public function destroy(Employee $employee)
    {
        $employee->achievements()->sync([]);
        $employee->delete();
    }




}
