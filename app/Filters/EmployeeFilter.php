<?php

namespace App\Filters;

use App\Filters\Components\Department;
use App\Filters\Components\Email;
use App\Filters\Components\Name;
use App\Filters\Components\Phone;

class EmployeeFilter extends BaseFilter
{
    protected function getFilters(): array
    {
        return [
            Name::class,
            Email::class,
            Phone::class,
            Department::class
        ];
    }
}
