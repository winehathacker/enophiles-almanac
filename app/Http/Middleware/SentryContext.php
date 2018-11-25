<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\User;
use Illuminate\Http\Request;

class SentryContext
{
    public function handle(Request $request, \Closure $next)
    {
        if (app()->bound('sentry')) {
            /** @var \Raven_Client $sentry */
            $sentry = app('sentry');

            /** @var User $user */
            if ($user = $request->user()) {
                $sentry->user_context([
                    'id' => $user->id,
                    'name' => $user->name,
                ]);
            }
        }

        return $next($request);
    }
}
