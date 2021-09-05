<?php

namespace App\Models;

use App\Http\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $brand_id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property CarBrand $carBrand
 */
class Car extends Model
{
    use HasFactory;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['brand_id', 'name', 'color', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carBrand()
    {
        return $this->belongsTo('App\Models\CarBrand', 'brand_id');
    }

    public function scopeFilter($builder, QueryFilter $filter){
        return $filter->apply($builder);
    }

}
