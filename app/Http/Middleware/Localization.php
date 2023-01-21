<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class Localization
{
    /**
     * Localization constructor.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $locale = $request->header('Accept-Language');

        if (!$locale) {
            $locale = $this->app->config->get('app.locale');
        }

        if (!array_key_exists($locale, $this->app->config->get('app.supported_languages'))) {
            return respondWithErrorClient(trans('lang.Language_Not_Supported'));
        }

        $this->app->setLocale($locale);

        $response = $next($request);

        $response->headers->set('Accept-Language', $locale);

        return $response;
    }
}
