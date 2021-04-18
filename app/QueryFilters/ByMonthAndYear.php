<?php

namespace App\QueryFilters;
use App\QueryFilters\Filter;
use Closure;
use Illuminate\Http\Request;

class ByMonthAndYear
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
    public function handle($request, Closure $next, ...$args)
    {

        if( ! $this->request->has($args[1])){
            return $next($request);
        }

        $builder = $next($request);

        return $this->applyFilters($builder, $args);
    }

    protected function applyFilters($builder, $args)
    {
        return $builder->whereYear($args[0],'=',request($args[1]))->whereMonth($args[0],'=',request($args[2]));
    }
}
