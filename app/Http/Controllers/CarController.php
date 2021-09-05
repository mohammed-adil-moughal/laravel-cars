<?php

namespace App\Http\Controllers;

use App\Http\Requests\Car\CarCreateRequest;
use App\Http\Requests\Car\CarUpdateRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Models\CarBrand;
use Illuminate\Http\Request;

use function PHPUnit\Framework\throwException;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CarResource::collection(Car::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarCreateRequest $request)
    {
        $data = $request->validated();

        $carBrand = CarBrand::findOrFail($data['brand']);
        if (!$carBrand) {
            abort(404, 'Invalid Car Brand');
        }

        $car = Car::find($data['name']);
        if ($car) {
            abort(400, 'Car name is already in use');
        }

        $car = new Car();
        $car->name = $data['name'];
        $car->brand_id = $data['brand'];

        try {
            $car->save();
        } catch (\Exception $e){
            abort(400, $e->getMessage());
        }

        return new CarResource($car);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = Car::find($id);
        if (!$car) {
            return [];
        }

        return new CarResource($car);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CarUpdateRequest $request, $id)
    {
        //
        $data = $request->validated();
        try {
            $car = Car::findOrFail($id);
        } catch (\Exception $e) {
            abort(404, 'Not found');
        }

        try {
            $carBrand = CarBrand::findOrFail($data['brand']);
        } catch (\Exception $e) {
            abort(404, 'Brand Not found');
        }

        $car->brand_id = $data['brand'];
        $car->save();

        return new CarResource($car);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $car = Car::findOrFail($id);
        } catch (\Throwable $e) {
            abort(404, 'Not found');
        }

        $car->delete();
        return ['deleted' => true];
    }
}
