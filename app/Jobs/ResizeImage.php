<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Spatie\Image\Enums\AlignPosition;
use Spatie\Image\Enums\ImageDriver as SpatieImageDriver;
use Spatie\Image\Image;

class ResizeImage implements ShouldQueue
{
    use Queueable;

    private $w, $h, $fileName, $path;

    public function __construct($filePath, $w, $h)
    {
        $this->path = dirname($filePath);
        $this->fileName = basename($filePath);
        $this->w = $w;
        $this->h = $h;
    }

    public function handle(): void
    {
        $srcPath = storage_path('app/public/' . $this->path . '/' . $this->fileName);
        $prefix = $this->h
            ? "crop_{$this->w}x{$this->h}_"
            : "crop_{$this->w}_";
        $destPath = storage_path('app/public/' . $this->path . '/' . $prefix . $this->fileName);

        $image = Image::useImageDriver(SpatieImageDriver::Imagick)->loadFile($srcPath);

        if ($this->h) {
            $image
                ->width($this->w)
                ->height($this->h)
                ->resizeCanvas($this->w, $this->h, AlignPosition::Center, false, '#ffffff');
        } else {
            $image->width($this->w);
        }

        $image->save($destPath);
    }
}
