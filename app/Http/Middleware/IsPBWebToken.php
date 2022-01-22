<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Rules\DownloadTokenRole;

class IsPBWebToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $validator = Validator::make($request->all(), [
            'token' => [
                'required', 'string', new DownloadTokenRole],
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withErrors($validator);
        }

        return $next($request);
    }
}
