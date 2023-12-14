<?php

namespace App\Services;

use App\Models\Department;
use Illuminate\Support\Facades\DB;

class DepartmentService
{
    public function store(array $data)
    {
        DB::transaction(function() use ($data){
            Department::create($data);
        });
    }


    public function update(Department $department, array $data)
    {
        DB::transaction(function() use ($department, $data){
            $department->update($data);
        }, 5);
    }

    public function destroy(Department $department)
    {
        $department->delete();
    }


}
