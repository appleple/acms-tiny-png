<?php

namespace Acms\Plugins\TinyPNG;

use App;
use ACMS_App;
use Acms\Services\Common\HookFactory;
use Acms\Services\Common\CorrectorFactory;

class ServiceProvider extends ACMS_App
{
    /**
     * @var string
     */
    public $version = '0.0.1';

    /**
     * @var string
     */
    public $name = 'TinyPNG';

    /**
     * @var string
     */
    public $author = 'com.appleple';

    /**
     * @var bool
     */
    public $module = false;

    /**
     * @var bool|string
     */
    public $menu = false;

    /**
     * @var string
     */
    public $desc = 'TinyPNGを使った画像のロスレス圧縮プラグインです。';

    /**
     * サービスの初期処理
     */
    public function init()
    {
        require_once dirname(__FILE__).'/vendor/autoload.php';

        $hook = HookFactory::singleton();
        $hook->attach('TinyPNG_Hook', new Hook);

        $corrector = CorrectorFactory::singleton();
        $corrector->attach('TinyPNG_Corrector', new Corrector);

        App::singleton('tiny_png', function () {
            return new Engine(config('tiny_png_api_key'));
        });

    }

    /**
     * インストールする前の環境チェック処理
     *
     * @return bool
     */
    public function checkRequirements()
    {
        return true;
    }

    /**
     * インストールするときの処理
     * データベーステーブルの初期化など
     *
     * @return void
     */
    public function install()
    {

    }

    /**
     * アンインストールするときの処理
     * データベーステーブルの始末など
     *
     * @return void
     */
    public function uninstall()
    {

    }

    /**
     * アップデートするときの処理
     *
     * @return bool
     */
    public function update()
    {
        return true;
    }

    /**
     * 有効化するときの処理
     *
     * @return bool
     */
    public function activate()
    {
        return true;
    }

    /**
     * 無効化するときの処理
     *
     * @return bool
     */
    public function deactivate()
    {
        return true;
    }
}
