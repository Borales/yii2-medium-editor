<?php
/**
 * @copyright Copyright (c) 2016 Alexandr Bordun
 * @link https://yiiframework.com.ua/
 * @license https://opensource.org/licenses/MIT MIT License
 */

namespace borales\medium;

use yii\helpers\Html;
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
     * @var array Editable tag options
     */
    public $tagOptions = [
        'class' => 'editable'
    ];

    /**
     * @return string
     */
    public function run()
    {
        $this->tagOptions['data-input'] = '#' . $this->options['id'];

        if($this->hasModel()) {
            $value = Html::getAttributeValue($this->model, $this->attribute);
            $inputTag = Html::activeHiddenInput($this->model, $this->attribute, $this->options);
        } else {
            $value = $this->value;
            $inputTag = Html::hiddenInput($this->name, $value, $this->options);
        }

        $this->registerAsset();

        return Html::tag('div', $value, $this->tagOptions) . $inputTag;
    }

    protected function registerAsset()
    {
        $settingsStr = Json::encode($this->settings);
        $asset = Asset::register($this->view);
        if($this->theme) {
            $asset->theme = $this->theme;
        }

        $js = <<<JS
var editor = new MediumEditor('.editable[data-input="#{$this->options['id']}"]', {$settingsStr});
$('.editable[data-input="#{$this->options['id']}"]').on("input", function() {var _this = $(this); $(_this.data("input")).val(_this.html());});
JS;

        $this->view->registerJs($js);
    }
}