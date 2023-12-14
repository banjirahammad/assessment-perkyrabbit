<?php

declare(strict_types=1);

namespace App\Filters\Components;

use Closure;

class Email implements ComponentInterface
{
    public function handle(array $content, Closure $next): mixed
    {
        if (isset($content['params']['email'])) {
            $value = $content['params']['email'];

            $content['builder']->where('email', 'like', '%' . $value . '%');
        }

        return $next($content);
    }
}
