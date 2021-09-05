<?php

namespace App\Jobs;

use App\Models\CarImage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class UploadCarImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected  $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if( !isset($this->data['file'])
            || !isset($this->data['fileName'])
            || !isset($this->data['fileExtension'])
            || !isset($this->data['description'])
        ){
            return;
        }

        //not ideal to have this in queue as tmp file can get lost :) esp if this runs on worker
        $img = file_get_contents($this->data['file']);

        $carId = $this->data['car_id'];

        $storagePath = 'public/cars/' . $carId . '/'. $this->data['fileName'] . '.' . $this->data['fileExtension'];
        Storage::put($storagePath, $img);

        $carImage = new CarImage();
        $carImage->description= $this->data['description'];
        $carImage->car_id = $carId;
        $carImage->file_key = $storagePath;
        $carImage->save();
    }
}
