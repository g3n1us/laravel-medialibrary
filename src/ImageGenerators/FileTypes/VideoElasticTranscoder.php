<?php

namespace Spatie\MediaLibrary\ImageGenerators\FileTypes;
	
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\Conversion\Conversion;
use Spatie\MediaLibrary\ImageGenerators\BaseGenerator;
use Aws\ElasticTranscoder\ElasticTranscoderClient;

class VideoElasticTranscoder extends BaseGenerator
{
    /**
    * Copy a placeholder image in place and wait for conversion to complete. Then replace with the first of the produced thumbnails, allowing for the user to select the generated image to use.
    */
    public function convert(string $file, Conversion $conversion = null) : string
    {
        $pathToImageFile = pathinfo($file, PATHINFO_DIRNAME).'/'.pathinfo($file, PATHINFO_FILENAME).'.jpg';
        file_put_contents($pathToImageFile, file_get_contents(__DIR__."/dummy.jpg"));
//         copy(__DIR__."/dummy.jpg", $pathToImageFile);

		return $pathToImageFile;

    }

    public function requirementsAreInstalled() : bool
    {
        return class_exists('\\Aws\\ElasticTranscoder\\ElasticTranscoderClient');
    }

    public function supportedExtensions() : Collection
    {
        return collect(['webm', 'mov', 'mp4']);
    }

    public function supportedMimeTypes() : Collection
    {
        return collect(['video/webm', 'video/mpeg', 'video/mp4', 'video/quicktime']);
    }
}
