<?php
/**
 * @copyright Copyright (c) 2016 Alexandr Bordun
 * @link https://yiiframework.com.ua/
 * @license https://opensource.org/licenses/MIT MIT License
 */

namespace borales\medium;

use yii\web\AssetBundle;

/**
 * Asset Bundle for Medium Editor widget
 *
 * @author Alexandr Bordun <bordun.alexandr@gmail.com>
 * @link https://yiiframework.com.ua/
 * @package borales\medium
 */
class Asset extends AssetBundle
{
    /**
     * @var bool Whether to use "latest" version from CDN
     */
    public $useLatest = true;

    /**
     * @var string if $useLatest is set to "false" - use this version
     */
    public $cdnVersion = '5.22.1';

    /**
     * @var array
     */
    public $css = [
        'css/medium-editor.min.css'
    ];

    /**
     * @var array
     */
    public $js = [
        'js/medium-editor.min.js'
    ];

    /**
     * @var string Medium Editor color theme
     */
    public $theme = 'default';

    /**
     * @var array List of available Medium Editor color themes
     */
    protected $availableThemes = [
        'beagle', 'bootstrap', 'default', 'flat', 'mani', 'roman', 'tim'
    ];

    /**
     * @param \yii\web\View $view
     */
    public function registerAssetFiles($view)
    {
        if(!in_array($this->theme, $this->availableThemes)) {
            $this->theme = 'default';
        }

        // Adding selected Medium theme
        $this->css[] = "css/themes/{$this->theme}.min.css";

        if(!$this->sourcePath) {
            foreach ($this->js as $jsIndex=>$jsFile) {
                $this->js[$jsIndex] = $this->getAssetUrl($jsFile);
            }

            foreach ($this->css as $cssIndex=>$cssFile) {
                $this->css[$cssIndex] = $this->getAssetUrl($cssFile);
            }
        }

        parent::registerAssetFiles($view);
    }

    /**
     * Get CDN URL
     * @param string $file
     * @return string
     */
    protected function getAssetUrl($file)
    {
        return sprintf('https://cdn.jsdelivr.net/medium-editor/%s/%s',
            ($this->useLatest ? 'latest' : $this->cdnVersion),
            $file
        );
    }
}