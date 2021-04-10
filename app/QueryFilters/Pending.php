<?php

namespace App\QueryFilters;

class Pending extends Filter
{

    protected function applyFilters($builder, $args)
    {
        return $builder->where('pending',request($this->filterName()));
    }

}
