#!/usr/bin/env php
<?php

use DarkGhostHunter\Preloader\Preloader;
use Symfony\Component\Finder\Finder;

include './vendor/autoload.php';

$root = __DIR__ . '/./';
$preloader = $root . 'preloader.php';

if( file_exists($preloader) ) {
    unlink($preloader);
}

Preloader::make()
    ->append(function (Finder $find) use ($root) {
        $find->files()->in($root . 'public')->name(['*.php']);
    })
    ->memoryLimit(64)
    ->writeTo($preloader);