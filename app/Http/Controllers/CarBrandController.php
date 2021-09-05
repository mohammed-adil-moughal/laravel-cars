<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarBrand\CarBrandRequest;
use App\Http\Requests\CarBrand\CarBrandUpdateRequest;
use App\Http\Resources\CarBrandResource;
use App\Models\CarBrand;

class CarBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carBrands = CarBrand::all();
        return CarBrandResource::collection($carBrands);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CarBrandRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarBrandRequest $request)
    {
        $data = $request->validated();

        $carBrand = new CarBrand();
        $carBrand->name = $data['name'];
        $carBrand->description= $data['description'];
        $carBrand->save();

        return new CarBrandResource($carBrand);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carBrand = CarBrand::find($id);

        if(!$carBrand) {
            abort('404', 'Not found');
        }
        return new CarBrandResource($carBrand);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param CarBrandUpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CarBrandUpdateRequest $request, $id)
    {
        //
        $data = $request->validated();
        try {
            $carBrand = CarBrand::findOrFail($id);
        } catch (\Throwable $e) {
            abort(404, 'Not found');
        }

        $carBrand->description= $data['description'];
        $carBrand->save();

        return new CarBrandResource($carBrand);
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
            $carBrand = CarBrand::findOrFail($id);
        } catch (\Throwable $e) {
            abort(404, 'Not found');
        }

        $carBrand->delete();
        return ['deleted' => true];
    }
}
