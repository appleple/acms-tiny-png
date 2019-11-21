<?php

namespace Acms\Plugins\TinyPNG;

class Engine
{
    public function __construct($key)
    {
        \Tinify\setKey($key);
    }

    public function compress($from, $to)
    {
        $source = \Tinify\fromFile($from);
        $source->toFile($to);
    }

    public function resize($from, $to, $type, $width, $height)
    {
        $option = array(
            'method' => $type,
        );
        if ($width > 0) {
            $option['width'] = $width;
        }
        if ($height > 0) {
            $option['height'] = $height;
        }
        $source = \Tinify\fromFile($from);
        $resized = $source->resize($option);
        $resized->toFile($to);
    }
}
