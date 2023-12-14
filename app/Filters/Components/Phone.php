<?php

declare(strict_types=1);

namespace App\Filters\Components;

use Closure;

class Phone implements ComponentInterface
{
    public function handle(array $content, Closure $next): mixed
    {
        if (isset($content['params']['phone'])) {
            $value = $content['params']['phone'];

            $content['builder']->where('phone', 'like', '%' . $value . '%');
        }

        return $next($content);
    }
}
