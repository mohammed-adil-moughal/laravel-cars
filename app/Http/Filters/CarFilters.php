<?php

namespace App\Http\Filters;

class CarFilters extends QueryFilter{

    /**
     * @param $color
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function color($color)
    {
        return $this->builder->where('color', $color);
    }

    /**
     * @param $brand
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function brand($brand)
    {
        return $this->builder->join(
            'car_brands',
            'cars.id',
            '=',
            'car_brands.id'
        )->where('car_brands.brand_name', $brand);
    }
}
