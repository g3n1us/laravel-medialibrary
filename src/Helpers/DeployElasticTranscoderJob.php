<?php

namespace Spatie\MediaLibrary\Helpers;

use Aws\ElasticTranscoder\ElasticTranscoderClient;
use Spatie\MediaLibrary\Media;

class DeployElasticTranscoderJob
{
    /**
     * Create a job and deploy to AWS.
     *
     * @return void
     */
    public function __construct(Media $media)
    {

		$video_id = $media->model_id;
		$media_id = $media->id;
		$filename = $media->file_name;

		$client = ElasticTranscoderClient::factory([
		    'region'  => config('medialibrary.elastic_transcoder.region'),
		    'version' => config('medialibrary.elastic_transcoder.api_version', "2012-09-25"),
		]);	    
		
		$result = $client->createJob([
		    'PipelineId' => config('medialibrary.elastic_transcoder.pipeline_id'),
		    'Input' => [
				'Key' => "$media_id/$filename",
							    
		    ],
		    'OutputKeyPrefix' => "$media_id/",
		    'Output' => [
			    'Key'         => "transcoded/$filename",
			    'PresetId' => config('medialibrary.elastic_transcoder.preset_id'),
			    'ThumbnailPattern' => "thumbnails/{resolution}/{count}",
		    ]
		]);
        
    }
	
}
