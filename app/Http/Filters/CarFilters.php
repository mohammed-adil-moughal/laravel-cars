<?php

namespace App\Http\Filters;

class CarFilters extends QueryFilter{

    public function color($color)
    {
        return $this->builder->where('color', $color);
    }

    public function brand($brand)
    {
        return $this->builder->join('car_brands','cars.id','=','car_brands.id')->where('car_brands.name', $brand);
    }
}
