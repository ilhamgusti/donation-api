<?php

namespace App\QueryFilters;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

abstract class Filter
{
    /**
     * The request.
     *
     * @var Request
     */
    protected $request;

    /**
     * Load the request via dependency injection into the filter.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the filter and return the builder.
     *
     * @param Builder $builder
     * @param Closure $next
     * @param mixture $args
     * @return void
     */
    public function handle($request, Closure $next, ...$args)
    {
        // dd($this->request->has($this->filterName()));
        if( !$this->request->has($this->filterName())){
            return $next($request);
        }

        $builder = $next($request);

        return $this->applyFilters($builder, $args);
    }

    protected abstract function applyFilters(Builder $builder, $args);

    protected function filterName()
    {
       return Str::snake(class_basename($this));
    }
}
