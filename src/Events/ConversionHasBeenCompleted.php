<?php

namespace Spatie\MediaLibrary\Events;

use Spatie\MediaLibrary\Media;
use Illuminate\Queue\SerializesModels;
use Spatie\MediaLibrary\Conversion\Conversion;
use Spatie\MediaLibrary\Helpers\DeployElasticTranscoderJob;
use Spatie\MediaLibrary\ImageGenerators\FileTypes\VideoElasticTranscoder;


class ConversionHasBeenCompleted
{
    use SerializesModels;

    /** @var \Spatie\MediaLibrary\Media */
    public $media;

    /** @var \Spatie\MediaLibrary\Conversion\Conversion */
    public $conversion;

    /**
     * @param \Spatie\MediaLibrary\Media                 $media
     * @param \Spatie\MediaLibrary\Conversion\Conversion $conversion
     */
    public function __construct(Media $media, Conversion $conversion)
    {
        $this->media = $media;

        $this->conversion = $conversion;
        
		if(in_array(VideoElasticTranscoder::class, config('medialibrary.image_generators'))){
	       $deploy = new DeployElasticTranscoderJob($media);
		}
        
    }
}
