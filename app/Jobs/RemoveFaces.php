<?php

namespace App\Jobs;

use App\Models\Image;
use Google\Cloud\Vision\V1\Feature;
use Google\Cloud\Vision\V1\Feature\Type;
use Illuminate\Contracts\Queue\ShouldQueue;
use Google\Cloud\Vision\V1\AnnotateImageRequest;
use Google\Cloud\Vision\V1\Image as VisionImage;
use Google\Cloud\Vision\V1\BatchAnnotateImagesRequest;
use Google\Cloud\Vision\V1\Client\ImageAnnotatorClient;
use Imagick;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;


class RemoveFaces implements ShouldQueue
{
    use Dispatchable, Queueable;

    /**
     * Create a new job instance.
     */
    private $article_image_id;

    public function __construct($article_image_id)
    {
        $this->article_image_id = $article_image_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $i = Image::find($this->article_image_id);
        if (!$i) {
            return;
        }

        $src = storage_path('app/public/' . $i->path);
        $image = file_get_contents($src);
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path('google_credential.json'));
        putenv('SSL_CERT_FILE=C:\php\8.4\cacert.pem');
        putenv('HTTP_PROXY');
        putenv('HTTPS_PROXY');
        putenv('ALL_PROXY');
        putenv('http_proxy');
        putenv('https_proxy');
        putenv('all_proxy');
        ini_set('curl.cainfo', 'C:\php\8.4\cacert.pem');
        ini_set('openssl.cafile', 'C:\php\8.4\cacert.pem');

        $googleVisionClient = new ImageAnnotatorClient();
        $google_image = new VisionImage([
            'content' => $image,
        ]);

        $googleFeature = new Feature();
        $googleFeature->setType(Type::FACE_DETECTION);

        $request = new AnnotateImageRequest();
        $request->setImage($google_image);
        $request->setFeatures([$googleFeature]);

        $batchRequest = new BatchAnnotateImagesRequest();
        $batchRequest->setRequests([$request]);

        $responseBatch = $googleVisionClient->batchAnnotateImages($batchRequest);
        $response = $responseBatch->getResponses()[0];
        $faces = $response->getFaceAnnotations();

        foreach ($faces as $face) {
            $vertices = $face->getBoundingPoly()->getVertices();
            $bounds = [];
            foreach ($vertices as $vertex) {
                $bounds[] = [$vertex->getX(), $vertex->getY()];
            }

            $x = max(0, $bounds[0][0]);
            $y = max(0, $bounds[0][1]);
            $w = max(1, $bounds[2][0] - $bounds[0][0]);
            $h = max(1, $bounds[2][1] - $bounds[0][1]);

            $image = new Imagick($src);
            $faceArea = clone $image;
            $faceArea->cropImage($w, $h, $x, $y);
            $faceArea->gaussianBlurImage(0, 12);

            $image->compositeImage($faceArea, Imagick::COMPOSITE_OVER, $x, $y);
            $image->writeImage($src);

            $faceArea->clear();
            $faceArea->destroy();
            $image->clear();
            $image->destroy();
        }

        $googleVisionClient->close();
    }
}
