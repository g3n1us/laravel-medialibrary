<?php

return [

    /*
     * The filesystems on which to store added files and derived images by default. Choose
     * one or more of the filesystems you configured in app/config/filesystems.php
     */
    'defaultFilesystem' => 'media',

    /*
     * The maximum file size of an item in bytes. Adding a file
     * that is larger will result in an exception.
     */
    'max_file_size' => 1024 * 1024 * 10,

    /*
     * This queue will be used to generate derived images.
     * Leave empty to use the default queue.
     */
    'queue_name' => '',

    /*
     * The class name of the media model to be used.
     */
    'media_model' => Spatie\MediaLibrary\Media::class,

    /*
     * The engine that will perform the image conversions.
     * Should be either `gd` or `imagick`
     */
    'image_driver' => 'gd',

    /*
     * When urls to files get generated this class will be called. Leave empty
     * if your files are stored locally above the site root or on s3.
     */
    'custom_url_generator_class' => null,

    /*
     * The class that contains the strategy for determining a media file's path.
     */
    'custom_path_generator_class' => null,

    's3' => [
        /*
         * The domain that should be prepended when generating urls.
         */
        'domain' => 'https://xxxxxxx.s3.amazonaws.com',
    ],

    'remote' => [
        /*
         * Any extra headers that should be included when uploading media to
         * a remote disk. Even though supported headers may vary between
         * different drivers, a sensible default has been provided.
         *
         * Supported by S3: CacheControl, Expires, StorageClass,
         * ServerSideEncryption, Metadata, ACL, ContentEncoding
         */
        'extra_headers' => [
            'CacheControl' => 'max-age=604800',
        ],
    ],

    /*
     * These generators will be used to created conversion of media files.
     */
    'image_generators' => [
        Spatie\MediaLibrary\ImageGenerators\FileTypes\Image::class,
        Spatie\MediaLibrary\ImageGenerators\FileTypes\Pdf::class,
        Spatie\MediaLibrary\ImageGenerators\FileTypes\Svg::class,
        Spatie\MediaLibrary\ImageGenerators\FileTypes\Video::class,
        // Spatie\MediaLibrary\ImageGenerators\FileTypes\VideoElasticTranscoder::class,
    ],
    
    /*
	 * Setting for AWS Elastic Transcoder if used for video conversions
	 * Example .env:
	 *
	 *  TRANSCODER_KEY=12345XXX
	 *  TRANSCODER_SECRET=12345XXX
	 *  TRANSCODER_REGION=us-east-1
	 *  TRANSCODER_BUCKET=imaginary-bucket-for-videos
	 *  TRANSCODER_PIPELINE_ID=1111122233334-56abc0	 
	 *  TRANSCODER_PRESET_ID=1111122233334-56abc0	 
	 *  TRANSCODER_API_VERSION=2012-09-25	 
	 *
     */
    
    'elastic_transcoder' => [
	    'key'          => env('TRANSCODER_KEY'),
	    'secret'       => env('TRANSCODER_SECRET'),
	    'region'       => env('TRANSCODER_REGION'),
	    'bucket'       => env('TRANSCODER_BUCKET'),
	    'pipeline_id'  => env('TRANSCODER_PIPELINE_ID'),
	    'preset_id'    => env('TRANSCODER_PRESET_ID'),
	    'api_version'  => env('TRANSCODER_API_VERSION', "2012-09-25"),
    ],
    
    /**
     * Determines if media files should be uploaded using streams as opposed to file_get_contents.
     */
     
    'upload_using_streams' => true,

    /*
     * The path where to store temporary files while performing image conversions.
     * If set to null, storage_path('medialibrary/temp') will be used.
     */
    'temporary_directory_path' => null,

    /*
     * FFMPEG & FFProbe binaries path, only used if you try to generate video
     * thumbnails and have installed the php-ffmpeg/php-ffmpeg composer
     * dependency.
     */
    'ffmpeg_binaries' => '/usr/bin/ffmpeg',
    'ffprobe_binaries' => '/usr/bin/ffprobe',
];
