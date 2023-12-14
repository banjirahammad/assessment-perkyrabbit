<?php

declare(strict_types=1);

namespace App\Filters\Components;

use Closure;

class Department implements ComponentInterface
{
    public function handle(array $content, Closure $next): mixed
    {
        if (isset($content['params']['department'])) {
            $value = $content['params']['department'];

            $content['builder']->where('department_id', '=', $value);
        }

        return $next($content);
    }
}
