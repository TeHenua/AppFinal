<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. A "local" driver, as well as a variety of cloud
    | based drivers are available for your choosing. Just store away!
    |
    | Supported: "local", "ftp", "s3", "rackspace"
    |
    */

    'default' => 'local',

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => 's3',

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    */

    'disks' => [

/***** aqui pongo las rutas donde se guardan los archivos *****/
        'dcustodia' => [
            'driver' => 'local',
            'root' => realpath('c:/nombreprograma/custodias'),
        ],

        'dmedica' => [
            'driver' => 'local',
            'root' => realpath('c:/nombreprograma/medicas'),
        ],

        'dlopd' => [
            'driver' => 'local',
            'root' => realpath('c:/nombreprograma/lopd'),
        ],

        'dvoto' => [
            'driver' => 'local',
            'root' => realpath('c:/nombreprograma/votos'),
        ],

        'dcomunicacion' => [
            'driver' => 'local',
            'root' => realpath('c:/nombreprograma/comunicaciones'),
        ],

        'dlopds' => [
            'driver' => 'local',
            'root' => realpath('c:/nombreprograma/lopdsocios'),
        ],

        'ddni' => [
            'driver' => 'local',
            'root' => realpath('c:/nombreprograma/dniSocios'),
        ],

        'ddiagnostico' => [
            'driver' => 'local',
            'root' => realpath('c:/nombreprograma/diagnostico'),
        ],

        'dlibrofamilia' => [
            'driver' => 'local',
            'root' => realpath('c:/nombreprograma/libroFamilia'),
        ],

/*************************************************************/
        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/'),
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => 'your-key',
            'secret' => 'your-secret',
            'region' => 'your-region',
            'bucket' => 'your-bucket',
        ],

    ],

];
