<?php
/**
 * @copyright Copyright (c) 2016 Alexandr Bordun
 * @link https://yiiframework.com.ua/
 * @license https://opensource.org/licenses/MIT MIT License
 */

namespace borales\medium;

use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\Json;
use yii\widgets\InputWidget;

/**
 * Renders Medium Editor widget
 *
 * @author Alexandr Bordun <bordun.alexandr@gmail.com>
 * @link https://yiiframework.com.ua/
 * @package borales\medium
 */
class Widget extends InputWidget
{
    /**
     * @var string Medium editor color theme. Default theme is "default" (in \borales\medium\Asset Bundle)
     */
    public $theme;

    /**
     * @var array Editor settings
     * @see https://github.com/yabwe/medium-editor/blob/master/OPTIONS.md
     */
    public $settings = [];

    /**
     * @var string[] List of external plugins
     */
    public $plugins = [];

    /**
     * @return string
     */
    public function run()
    {
        $this->registerAsset();

        if($this->hasModel()) {
            return Html::activeTextarea($this->model, $this->attribute, $this->options);
        }
        return Html::textarea($this->name, $this->value, $this->options);
    }

    protected function registerAsset()
    {
        $settingsStr = Json::encode($this->settings);
        $asset = Asset::register($this->view);
        if($this->theme) {
            $asset->theme = $this->theme;
        }

        $this->view->registerJs("var {$this->getEditorVarName()} = new MediumEditor('{$this->getEditorSelector()}', {$settingsStr});");
        array_map([$this, 'registerPlugin'], $this->plugins);
    }

    /**
     * @return string
     */
    protected function getEditorSelector()
    {
        return "#{$this->options['id']}";
    }

    /**
     * @return string
     */
    protected function getEditorVarName()
    {
        return Inflector::variablize('editor_' . $this->options['id']);
    }

    /**
     * @param string $pluginInitString
     */
    protected function registerPlugin($pluginInitString)
    {
        $varName = $this->getEditorVarName();
        $selector = $this->getEditorSelector();

        $this->view->registerJs("(function(selector, editor) { $pluginInitString })('{$selector}', {$varName});");
    }
}