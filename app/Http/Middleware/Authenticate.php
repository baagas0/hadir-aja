<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
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
            dd('loginnnn sek');
            die();
            // return redirect()->guest(route('login'));
            // $path = RouteServiceProvider::HOME;
            // header("Location: /login");
            // die();
        }

    }

}
