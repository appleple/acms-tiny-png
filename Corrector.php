<?php

namespace Acms\Plugins\TinyPNG;

use Acms\Services\Facades\Storage;

class Corrector
{
    /**
     * @param $src
     * @param $args
     * @return mixed
     */
    public function resizeTinyPng($src, $args)
    {
        $type = isset($args[0]) ? $args[0] : 'fit'; // scale | fit | cover | thumb
        $width = isset($args[1]) ? intval($args[1]) : 300;
        $height = isset($args[2]) ? intval($args[2]) : 0;
        $pfx = 'mode_tinypng_';
        if (!empty($width)) {
            $pfx .= 'w' . $width;
        }
        if (!empty($height)) {
            if (!empty($pfx)) {
                $pfx .= '_';
            }
            $pfx .= 'h' . $height;
        }
        foreach (array('', REQUEST_URL, ARCHIVES_DIR, REVISON_ARCHIVES_DIR, MEDIA_LIBRARY_DIR) as $archive_dir) {
            $tmpPath = $archive_dir . normalSizeImagePath($src);
            $destPath = trim(dirname($tmpPath), '/') . '/' . $pfx . '-' . Storage::mbBasename($tmpPath);
            $destPathVars = trim(dirname($src), '/') . '/' . $pfx . '-' . Storage::mbBasename($tmpPath);
            $largePath = otherSizeImagePath($tmpPath, 'large'); // large path

            if (Storage::isReadable($destPath)) {
                return $destPathVars;
            }
            if (Storage::isReadable($largePath)) {
                $srcPath = $largePath;
                break;
            }
            if (Storage::isReadable($tmpPath)) {
                $srcPath = $tmpPath;
                break;
            }
        }
        if (empty($srcPath)) {
            return $src;
        }
        if (!$xy = Storage::getImageSize($srcPath)) {
            return $src;
        }
        $ratio = $xy[1] / $xy[0];
        $option = array(
            'method' => $type,
            'width' => $width,
        );
        if ($height > 0) {
            $option['height'] = $height;
        } else {
            $option['height'] = intval($width * $ratio);
        }
        $engine = \App::make('tiny_png');
        $engine->resize($srcPath, $destPath, $option);

        return $destPathVars;
    }
}
