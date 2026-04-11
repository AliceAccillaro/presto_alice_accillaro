<?php

namespace App\Jobs;

use App\Models\Image;
use Google\Cloud\Vision\V1\Feature;
use Google\Cloud\Vision\V1\Feature\Type;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Google\Cloud\Vision\V1\AnnotateImageRequest;
use Google\Cloud\Vision\V1\BatchAnnotateImagesRequest;
use Google\Cloud\Vision\V1\Client\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\Image as VisionImage;

class GoogleVisionLabelImage implements ShouldQueue
{
    use Queueable;

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

        $image = file_get_contents(storage_path('app/public/' . $i->path));
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
            'content' => $image
        ]);

        $googleFeature = new Feature();
        $googleFeature->setType(Type::LABEL_DETECTION);

        $request = new AnnotateImageRequest();
        $request->setImage($google_image);
        $request->setFeatures([$googleFeature]);

        $batchRequest = new BatchAnnotateImagesRequest();
        $batchRequest->setRequests([$request]);

        $responseBatch = $googleVisionClient->batchAnnotateImages($batchRequest);
        $response = $responseBatch->getResponses();

        $labels = $response[0]->getLabelAnnotations();

        if ($labels) {
            $result = [];
            foreach ($labels as $label) {
                $result[] = $label->getDescription();
            }
            $i->labels = $result;
            $i->save();
        }

        $googleVisionClient->close();
    }
}
