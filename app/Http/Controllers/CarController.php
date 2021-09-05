<?php

namespace App\Http\Controllers;

use App\Http\Filters\CarFilters;
use App\Http\Requests\Car\CarCreateRequest;
use App\Http\Requests\Car\CarImageRequest;
use App\Http\Requests\Car\CarUpdateRequest;
use App\Http\Resources\CarImageResource;
use App\Http\Resources\CarResource;
use App\Jobs\UploadCarImage;
use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarImage;
use Illuminate\Http\Request;

use function PHPUnit\Framework\throwException;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(CarFilters $filters)
    {

        $cars = Car::filter($filters)->get();
        return CarResource::collection($cars);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param CarCreateRequest $request
     * @return CarResource
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
        $car->color = $data['color'];
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
     * @return CarResource
     */
    public function show($id)
    {
        $car = Car::find($id);
        if (!$car) {
            abort(404, 'Not found');
        }

        return new CarResource($car);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CarUpdateRequest $request
     * @param int $id
     * @return CarResource
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


        if (isset($data['brand'])) {
            try {
                CarBrand::findOrFail($data['brand']);
            } catch (\Exception $e) {
                abort(404, 'Brand Not found');
            }
            $car->brand_id = $data['brand'];
        }

        if(isset($data['color'])) {
            $car->color = $data['color'];
        }

        $car->save();

        return new CarResource($car);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return bool[]
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


    /**
     * @param CarImageRequest $request
     * @return string[]
     */
    public function uploadCarImage(CarImageRequest $request) {
        $data = $request->validated();

        try {
           Car::findOrFail($data['car']);
        } catch (\Throwable $e) {
            abort(404, 'Car Not found');
        }

        UploadCarImage::dispatch(
            [
                 'description' => $data['description'],
                 'car_id' => $data['car'],
                 'file' => $request->file->getRealPath(),
                 'fileName' => $request->file->getFilename(),
                 'fileExtension' => $request->file->extension()
            ]
        );

       return ['success' => true];
    }
}
