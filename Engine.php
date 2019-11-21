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

    public function resize($from, $to, $option)
    {
        $source = \Tinify\fromFile($from);
        $resized = $source->resize($option);
        $resized->toFile($to);
    }
}
