<?php

namespace Acms\Plugins\TinyPNG;

use Acms\Services\Facades\Storage;

class Hook
{
    protected $tinyPng = false;

    /**
     * メディアデータ作成
     * @param string $path 作成先パス
     *
     */
    public function mediaCreate($path)
    {
        try {
            if (!Storage::getImageSize($path)) {
                return;
            }
            if ($this->tinyPng === false) {
                $this->tinyPng = \App::make('tiny_png');
            }
            $this->tinyPng->compress($path, $path);
        } catch (\Exception $e) {
            userErrorLog($e->getMessage());
        }
    }
}
