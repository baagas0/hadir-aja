<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }

    // Add new method
    protected function unauthenticated($request, array $guards)
    {

        if(str_contains($request->url(), '/api')) {
            abort(
                response()->json(
                [
                    'api_status' => '401',
                    'message' => 'Unauthenticated',
                ], 401)
            );
        } else {
            // return redirect()->guest(route('login'));
            // header("Location: /login");
            // die();
        }

    }

}
